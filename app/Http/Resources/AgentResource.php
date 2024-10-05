<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgentResource extends JsonResource
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
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'long_description' => $this->resource->long_description,
            'activity' => $this->resource->activity,
            'performances' => $this->whenLoaded(
                'performances',
                fn() => PerformanceResource::collection($this->resource->performances)
            ),
            "performance_activity" => $this->whenLoaded(
                'pivot',
                fn() => $this->resource->pivot->activity
            ),
            "performance_exception" => $this->whenLoaded(
                'pivot',
                fn() => $this->resource->pivot->exception
            ),


        ];
    }
}
