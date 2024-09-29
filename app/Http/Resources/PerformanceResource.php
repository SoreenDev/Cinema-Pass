<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PerformanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'id' => $this->resource->id,
            'category_id' => $this->resource->category_id,
            'duration' => $this->resource->duration,
            'age_group' => $this->resource->age_group,
            'description' => $this->resource->description,
            'price' => $this->resource->price,
            'production_date' => $this->resource->production_date,
            'performance_agent' => $this->whenLoaded(
                'performance_agent',
                fn () => $this->resource->performance_agent
            ),
            'daily_screenings' => $this->whenLoaded(
                'daily_screenings',
                fn () => $this->resource->daily_screenings
            ),
            'comments' => $this->whenLoaded(
                'comments',
                fn () => $this->resource->comments
            ),
            'scores' => $this->whenLoaded(
                'scores',
                fn () => $this->resource->scores
            ),
        ];
    }
}
