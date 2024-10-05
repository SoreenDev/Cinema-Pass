<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyScreeningResource extends JsonResource
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
            'city_id' => $this->whenLoaded(
                'city',
                fn()=> CityResource::make($this->resource->city),
                $this->resource->city_id
            ),
            'cinema_id' => $this->whenLoaded(
                'cinema',
                fn()=> CinemaResource::make($this->resource->cinema),
                $this->resource->cinema_id
            ),
            'performance_id' => $this->whenLoaded(
                'performance',
                fn()=> PerformanceResource::make($this->resource->performance),
                $this->resource->performance_id
            ),
            'start_time' => $this->resource->start_time,
            'final_ticket_cost' => $this->resource->final_ticket_cost,
        ];
    }
}
