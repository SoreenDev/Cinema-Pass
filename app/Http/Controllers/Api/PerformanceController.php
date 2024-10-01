<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Performance\StoreRequest;
use App\Http\Requests\Performance\UpdateRequest;
use App\Http\Resources\PerformanceResource;
use App\Models\Performance;
use Spatie\QueryBuilder\QueryBuilder;

class PerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $performances = QueryBuilder::for(Performance::class)
            ->allowedIncludes(['comments','scores','dailyScreenings','agents'])
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
        $performance = Performance::create($request->validated());
        foreach ($request->agents as $agent) {
            $performance->agents()->attach($agent['id'], [
                "activity" => $agent["activity"],
                "exception" => $agent["exception"],
            ]);
        }

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
        $performance->update($request->validated());
        if ($request->filled('agents')) {
            foreach ($request->agents as $agent) {
                $performance->agents()->sync($agent['id'], [
                    "activity" => $agent["activity"],
                    "exception" => $agent["exception"],
                ]);
            }
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
        $performance->delete();
        return $this->successResponse(message: 'Successfully deleted performance');
    }
}
