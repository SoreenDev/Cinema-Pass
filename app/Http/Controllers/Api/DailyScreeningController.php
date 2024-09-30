<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DailyScreening\StoreRequest;
use App\Http\Requests\DailyScreening\UpdateRequest;
use App\Http\Resources\DailyScreeningResource;
use App\Models\Cinema;
use App\Models\DailyScreenings;
use App\Models\Performance;
use Spatie\QueryBuilder\QueryBuilder;

class DailyScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daily_screenings =  QueryBuilder::for(DailyScreenings::class)
            ->get();

        return $this->successResponseWithAdditional(
            DailyScreeningResource::collection($daily_screenings),
            'All Daily Screenings'
        );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $start_time = $request->date .' 0'. $request->hour.':00:00';
        if ($request->date < now()->day(1))
            return $this->errorResponse('date must be after today');
        if
        (
            DailyScreenings::where('start_time', $start_time)
                ->where('cinema_id',$request->cinema_id)->exists()
        ){
            return $this->errorResponse('DailyScreening already exists');
        }


        $cinemas = Cinema::find($request->cinema_id)->first();
        $performance = Performance::find($request->performance_id)->first();
        $final_ticket_cost = $performance->price + $cinemas->entry_fee;

        $daily_screening = DailyScreenings::create([
            ...$request->validated(),
            'city_id' => $cinemas->city_id,
            'start_time' => $start_time,
            'final_ticket_cost' => $final_ticket_cost,
        ]);
        return $this->successResponse(
            DailyScreeningResource::make($daily_screening),
            'Successfully Created Daily Screening'
        );

    }

    /**
     * Display the specified resource.
     */
    public function show(DailyScreenings $daily_screening)
    {
        return $this->successResponse(
            DailyScreeningResource::make($daily_screening),
            'Successfully find daily screening'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, DailyScreenings $daily_screening)
    {
        if (isset($request->date) && isset($request->hour)) {
            $start_time = $request->date . ' 0' . $request->hour . ':00:00';

            if ($request->date < now()->day(1))
                return $this->errorResponse('date must be after today');
            if
            (
                DailyScreenings::where('start_time', $start_time)
                    ->where('cinema_id', $request->cinema_id)->exists()
            ) {
                return $this->errorResponse('DailyScreening already exists');
            }
        }


        $cinemas = Cinema::find($request->cinema_id)->first();
        $performance = Performance::find($request->performance_id)->first();
        $final_ticket_cost = $performance->price + $cinemas->entry_fee;

        $daily_screening->update([
            ...$request->validated(),
            'city_id' => $cinemas->city_id,
            'start_time' => $start_time?? $daily_screening->start_time,
            'final_ticket_cost' => $final_ticket_cost,
        ]);
        return $this->successResponse(
            DailyScreeningResource::make($daily_screening),
            'Successfully Update Daily Screening'
        );


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DailyScreenings $daily_screening)
    {
        $daily_screening->delete();
        return $this->successResponse(  message: 'Successfully Delete Daily Screening');
    }
}
