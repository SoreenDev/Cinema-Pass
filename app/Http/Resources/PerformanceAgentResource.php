<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PerformanceAgentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'activity' => $this->resource->activity,
            'exception' => $this->resource->exception,
            'agent' => $this->whenLoaded(
                'agent',
                fn() => AgentResource::make($this->resource->agent),
                $this->resource->agent_id,
            ),
            'performance' => $this->whenLoaded(
                'performance',
                fn() => PerformanceResource::make($this->resource->performance),
                $this->resource->performance_id,
            )
        ];
    }
}
