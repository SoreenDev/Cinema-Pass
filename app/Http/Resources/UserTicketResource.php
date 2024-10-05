<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTicketResource extends JsonResource
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
            'user' => $this->whenLoaded(
                'user',
                fn() => UserResource::make($this->resource->user),
                $this->resource->user_id
            ),
            'daily_screening' => $this->whenLoaded(
                'daily_screening',
                fn() => DailyScreeningResource::make($this->resource->daily_screening),
                $this->resource->daily_screenings_id
            ),
            'performance' => $this->whenLoaded(
                'performance',
                fn() => PerformanceResource::make($this->resource->performance),
                $this->resource->performance_id
            ),
            'status_payment' => $this->resource->status_payment,
            'price' => $this->resource->price,
        ];
    }
}
