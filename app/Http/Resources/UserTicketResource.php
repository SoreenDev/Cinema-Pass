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
            'user_id' => $this->resource->user_id,
            'daily_screening_id' => $this->resource->daily_screenings_id,
            'performance_id' => $this->resource->performance_id,
            'status_payment' => $this->resource->status_payment,
            'price' => $this->resource->price,
        ];
    }
}
