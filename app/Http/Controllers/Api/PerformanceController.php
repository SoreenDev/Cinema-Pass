<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreRequest as CommentStoreRequest;
use App\Http\Requests\Performance\StoreRequest;
use App\Http\Requests\Performance\UpdateRequest;
use App\Http\Requests\Score\StoreRequest as ScoreStoreRequest;
use App\Http\Resources\PerformanceResource;
use App\Models\Performance;
use App\Models\UserTicket;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class PerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $performances = QueryBuilder::for(Performance::class)
            ->allowedIncludes(['comments','scores','dailyScreenings','agents.performances'])
            ->get();

        return $this->successResponseWithAdditional(
            PerformanceResource::collection($performances),
            'All Performances'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Gate::authorize('create', Performance::class);
        $performance = Performance::create($request->validated());

        foreach ($request->agents as $agent) {
            $performance->agents()->attach($agent['id'], [
                "activity" => $agent["activity"],
                "exception" => $agent["exception"],
            ]);
        }

        if ($request->image)
            $performance->addMediaFromRequest('image')
                ->setFileName($performance->name)
                ->toMediaCollection('image');

        return $this->successResponse(
            PerformanceResource::make($performance->load(['comments','scores','dailyScreenings','agents'])),
            'Successfully Created Performance'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Performance $performance)
    {
        return $this->successResponse(
            PerformanceResource::make($performance->load(['comments','scores','dailyScreenings','agents'])),
            'Successfully find performance'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Performance $performance)
    {
        Gate::authorize('update', Performance::class);
        $performance->update($request->validated());
        if ($request->filled('agents')) {
            foreach ($request->agents as $agent) {
                $performance->agents()->sync($agent['id'], [
                    "activity" => $agent["activity"],
                    "exception" => $agent["exception"],
                ]);
            }
        }
        if ($request->image) {
            $performance->clearMediaCollection('image');
            $performance->addMediaFromRequest('image')
                ->setFileName($performance->name)
                ->toMediaCollection('image');
        }
        return $this->successResponse(
            PerformanceResource::make($performance->load(['comments','scores','dailyScreenings','agents'])),
            'Successfully Updated Performance'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Performance $performance)
    {
        Gate::authorize('delete', Performance::class);
        $performance->delete();
        return $this->successResponse(message: 'Successfully deleted performance');
    }
    public function comment(Performance $performance, CommentStoreRequest $request)
    {
        $performance->comments()->create([
            ...$request->validated(),
            'user_id' => auth()->id(),
        ]);

        return $this->successResponse(
            PerformanceResource::make($performance->load(['comments','scores','dailyScreenings','agents'])),
            'Successfully created comment'
        );
    }
    public function givingScore(Performance $performance, ScoreStoreRequest $request)
    {
        if (! UserTicket::where('user_id', auth()->id())->where('performance_id', $performance->id)->exists())
            $this->errorResponse('You do not have the necessary conditions to register the score!');

        $performance->scores()->create([
            'point' => $request->point,
            'user_id' => auth()->id()??1,
        ]);

        return $this->successResponse(
            PerformanceResource::make($performance->load(['comments','scores','dailyScreenings','agents'])),
            'Successfully Giving score'
        );
    }
}
