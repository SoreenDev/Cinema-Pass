<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerformanceAgent\StoreRequest;
use App\Http\Requests\PerformanceAgent\UpdateRequest;
use App\Http\Resources\PerformanceAgentResource;
use App\Http\Trait\BasicApiResponseTrait;
use App\Models\PerformanceAgent;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PerformanceAgentController extends Controller
{
    use BasicApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $PerformanceAgents = QueryBuilder::for(PerformanceAgent::class)
            ->allowedIncludes(['performance','agent'])
            ->get();
        return $this->successResponseWithAdditional(
            PerformanceAgentResource::collection($PerformanceAgents),
            'All Performance Agents'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $PerformanceAgent = PerformanceAgent::create($request->validated());
        return $this->successResponse(
            PerformanceAgentResource::make($PerformanceAgent->load(['performance','agent'])),
            'Successfully Created Performance Agent'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(PerformanceAgent $performance_agent)
    {
        return $this->successResponse(
            PerformanceAgentResource::make($performance_agent->load('performance','agent')),
            'Successfully find Performance Agent'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, PerformanceAgent $performance_agent)
    {
        $performance_agent->update($request->validated());

        return $this->successResponse(
            PerformanceAgentResource::make($performance_agent->load('performance','agent')),
            'Successfully update Performance Agent'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PerformanceAgent $performance_agent)
    {
        $performance_agent->delete();
        return $this->successResponse(message: 'Successfully   lly Performance Agent Deleted');
    }
}
