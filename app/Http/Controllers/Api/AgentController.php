<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Agent\StoreRequest;
use App\Http\Requests\Agent\UpdateRequest;
use App\Http\Resources\AgentResource;
use App\Http\Trait\BasicApiResponseTrait;
use App\Models\Agent;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class AgentController extends Controller
{
    use BasicApiResponseTrait;
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
        $agent->delete();
        return $this->successResponse(message: 'Successfully deleted agent');
    }
}
