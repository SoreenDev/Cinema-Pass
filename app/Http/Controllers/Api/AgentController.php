<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Agent\StoreRequest;
use App\Http\Requests\Agent\UpdateRequest;
use App\Http\Resources\AgentResource;
use App\Models\Agent;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class AgentController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except:['index', 'show']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agents = QueryBuilder::for(Agent::class)
            ->allowedIncludes(['performances'])
            ->get();

        return $this->successResponse(
          AgentResource::collection($agents),
          'All agents listed',
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Gate::authorize('create', Agent::class);
        $agent = Agent::create($request->validated());
        return $this->successResponse(
            AgentResource::make($agent->load(['performances'])),
            'Agent created successfully',
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        return $this->successResponse(
            AgentResource::make($agent->load(['performances'])),
            'Successfully find agent'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Agent $agent)
    {
        Gate::authorize('update', $agent);
        $agent->update($request->validated());
        return $this->successResponse(
            AgentResource::make($agent->load(['performances'])),
            'Agent updated successfully',
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent)
    {
        Gate::authorize('delete', $agent);
        $agent->delete();
        return $this->successResponse(message: 'Successfully deleted agent');
    }
}
