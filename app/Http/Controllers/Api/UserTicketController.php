<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusPaymentEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserTicket\StoreRequest;
use App\Http\Requests\UserTicket\UpdateRequest;
use App\Http\Resources\UserTicketResource;
use App\Models\DailyScreenings;
use App\Models\UserTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class UserTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny',UserTicket::class);
        $userTickets = QueryBuilder::for(UserTicket::class)
            ->allowedIncludes(['user','daily_screening','performance'])
            ->get();

        return $this->successResponseWithAdditional(
            USerTicketResource::collection($userTickets),
            'All Tickets'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $dailyScreening = DailyScreenings::find($request->daily_screenings_id);
        if ($dailyScreening > now())
            $this->errorResponse(message: 'The desired ticket has expired !');
        $userTicket = UserTicket::create([
            'daily_screenings_id' => $dailyScreening->id,
            'user_id' => auth()->id()??1,
            'price' => $dailyScreening->final_ticket_cost,
            'status_payment' => StatusPaymentEnum::Waiting->value
        ]);
        return $this->successResponse(
            UserTicketResource::make($userTicket->load(['user','daily_screening','performance'])),
            'Created Ticket'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(UserTicket $userTicket)
    {
        Gate::authorize('view',[UserTicket::class,$userTicket]);
        return $this->successResponse(
            UserTicketResource::make($userTicket->load(['user','daily_screening','performance'])),
            'Successfully find'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, UserTicket $userTicket)
    {
        Gate::authorize('update',[UserTicket::class,$userTicket]);
        $dailyScreening = DailyScreenings::find($request->daily_screenings_id);
        if ($dailyScreening > now())
            $this->errorResponse(message: 'The desired ticket has expired !');
        $userTicket->update([
            'performance_id'=> $dailyScreening->performance_id,
            'daily_screenings_id' => $dailyScreening->id,
            'user_id' => auth()->id()??1,
            'price' => $dailyScreening->final_ticket_cost,
            'status_payment' => StatusPaymentEnum::Waiting->value
        ]);
        return $this->successResponse(
            UserTicketResource::make($userTicket->load(['user','daily_screening','performance'])),
            'Created Ticket'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserTicket $userTicket)
    {
        Gate::authorize('delete',[UserTicket::class,$userTicket]);
        $userTicket->delete();
        return $this->successResponse(message: 'Successfully deleted ticket.');
    }

    public function ticketPaid(UserTicket $userTicket)
    {
        Gate::authorize('paid',[UserTicket::class,$userTicket]);
        $userTicket->update([
            'status_payment' => StatusPaymentEnum::Paid->value
        ]);
        return $this->successResponse(
            UserTicketResource::make($userTicket->load(['user','daily_screening','performance'])),
            'Successfully paid ticket'
        );
    }
}
