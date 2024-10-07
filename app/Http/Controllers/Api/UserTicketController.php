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
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class UserTicketController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum')
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny',UserTicket::class);
        $Tickets = QueryBuilder::for(UserTicket::class)
            ->allowedIncludes(['user','daily_screening','performance'])
            ->get();

        return $this->successResponseWithAdditional(
            USerTicketResource::collection($Tickets),
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
        $ticket = UserTicket::create([
            'daily_screenings_id' => $dailyScreening->id,
            'user_id' => auth()->id()??1,
            'price' => $dailyScreening->final_ticket_cost,
            'status_payment' => StatusPaymentEnum::Waiting->value
        ]);
        return $this->successResponse(
            UserTicketResource::make($ticket->load(['user','daily_screening','performance'])),
            'Created Ticket'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(UserTicket $ticket)
    {
        Gate::authorize('view',[UserTicket::class,$ticket]);
        return $this->successResponse(
            UserTicketResource::make($ticket->load(['user','daily_screening','performance'])),
            'Successfully find'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, UserTicket $ticket)
    {
        Gate::authorize('update',[UserTicket::class,$ticket]);
        $dailyScreening = DailyScreenings::find($request->daily_screenings_id);
        if ($dailyScreening > now())
            $this->errorResponse(message: 'The desired ticket has expired !');
        $ticket->update([
            'performance_id'=> $dailyScreening->performance_id,
            'daily_screenings_id' => $dailyScreening->id,
            'user_id' => auth()->id()??1,
            'price' => $dailyScreening->final_ticket_cost,
            'status_payment' => StatusPaymentEnum::Waiting->value
        ]);
        return $this->successResponse(
            UserTicketResource::make($ticket->load(['user','daily_screening','performance'])),
            'Created Ticket'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserTicket $ticket)
    {
        Gate::authorize('delete',[UserTicket::class,$ticket]);
        $ticket->delete();
        return $this->successResponse(message: 'Successfully deleted ticket.');
    }

    public function ticketPaid(UserTicket $ticket)
    {
        Gate::authorize('paid',[UserTicket::class,$ticket]);
        $ticket->update([
            'status_payment' => StatusPaymentEnum::Paid->value
        ]);
        return $this->successResponse(
            UserTicketResource::make($ticket->load(['user','daily_screening','performance'])),
            'Successfully paid ticket'
        );
    }
}
