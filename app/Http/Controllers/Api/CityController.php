<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\StoreRequest;
use App\Http\Requests\City\UpdateRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Spatie\QueryBuilder\QueryBuilder;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = QueryBuilder::for(City::class)
            ->allowedIncludes("cinemas")
            ->get();

        return $this->successResponseWithAdditional(
            CityResource::collection($cities),
            'all cities'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $city = City::create($request->validated());
        return $this->successResponse(
            CityResource::make($city),
            'Successfully Created City'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        return $this->successResponse(
            CityResource::make($city->load('cinemas')),
            'Successfully Find City'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, City $city)
    {
        $city->update($request->validated());

        return $this->successResponse(
            CityResource::make($city->load('cinemas')),
            'Successfully Updated City'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
        return $this->successResponse([], 'Successfully Deleted City');
    }
}
