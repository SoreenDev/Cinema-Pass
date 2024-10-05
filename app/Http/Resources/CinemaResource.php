<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CinemaResource extends JsonResource
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
            'address' => $this->resource->address,
                'city_id' => $this->whenLoaded(
                    'city',
                    fn()=> CityResource::make($this->resource->city),
                    $this->resource->city_id
                ),
            'location' => $this->resource->location,
            'description' => $this->resource->description,
            'phone' => $this->resource->phone,
            'entry_fee' => $this->resource->entry_fee,
            'daily_screenings' => $this->whenLoaded(
              'daily_screenings',
              fn () => DailyScreeningResource::collection($this->resource->daily_screenings)
            ),
            'comments' => $this->whenLoaded(
                'comments',
                fn () => CommentResource::collection($this->resource->comments)
            ),
            'scores' => $this->whenLoaded(
              'scores',
                fn () => ScoreResource::collection($this->resource->scores)
            ),
            'image' => $this->when(
                $this->resource->getFirstMediaUrl('image'),
                $this->resource->getFirstMediaUrl('image')
            )



        ];
    }
}
