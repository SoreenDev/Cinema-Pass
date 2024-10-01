<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cinema\StoreRequest;
use App\Http\Requests\Comment\StoreRequest as CommentStoreRequest;
use App\Http\Requests\Cinema\UpdateReaquest;
use App\Http\Requests\Score\StoreRequest as ScoreStoreRequest;
use App\Http\Resources\CinemaResource;
use App\Models\Cinema;
use App\Models\UserTicket;
use Spatie\QueryBuilder\QueryBuilder;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cinemas = QueryBuilder::for(Cinema::class)
            ->allowedIncludes(['comments','scores','daily_screenings'])
            ->get();

        return $this->successResponseWithAdditional(
            CinemaResource::collection($cinemas),
            'All cinema'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $cinema = Cinema::create($request->validated());

        return $this->successResponseWithAdditional(
            CinemaResource::make($cinema->load(['comments','scores','daily_screenings'])),
            'Successfully created cinema'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Cinema $cinema)
    {
        return $this->successResponse(
            CinemaResource::make($cinema->load(['comments','scores','daily_screenings'])),
            'Successfully find cinema'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReaquest $request, Cinema $cinema)
    {
        $cinema->update($request->validated());

        return $this->successResponse(
            CinemaResource::make($cinema->load(['comments','scores','daily_screenings'])),
            'Successfully updated cinema'
        );

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cinema $cinema)
    {
        $cinema->delete();

        return $this->successResponse(message:'Successfully deleted cinema');
    }

    public function comment(Cinema $cinema, CommentStoreRequest $request)
    {
        $cinema->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        return $this->successResponse(
            CinemaResource::make($cinema->load(['comments','scores','daily_screenings'])),
            'Successfully created comment'
        );
    }

    public function givingScore(Cinema $cinema, ScoreStoreRequest $request)
    {
        if (! UserTicket::where('user_id', auth()->id())->where('cinema_id', $cinema->id)->exists())
            $this->errorResponse('You do not have the necessary conditions to register the score!');

        $cinema->scores()->create([
            'point' => $request->point,
            'user_id' => auth()->id(),
        ]);

        return $this->successResponse(
            CinemaResource::make($cinema->load(['comments','scores','daily_screenings'])),
            'Successfully Giving score'
        );
    }

}
