<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cinema\StoreReaquest;
use App\Http\Requests\Cinema\UpdateReaquest;
use App\Http\Resources\CinemaResource;
use App\Models\Cinema;
use Illuminate\Http\Request;
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
    public function store(StoreReaquest $request)
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
}
