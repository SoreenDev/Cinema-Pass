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
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'category' => $this->whenLoaded(
                'category',
                fn() => CategoryResource::make($this->resource->category),
                $this->resource->category_id
            ),
            'duration' => $this->resource->duration,
            'age_group' => $this->resource->age_group,
            'description' => $this->resource->description,
            'price' => $this->resource->price,
            'production_date' => $this->resource->production_date,
            'dailyScreenings' => $this->whenLoaded(
                'dailyScreenings',
                fn () => DailyScreeningResource::collection($this->resource->dailyScreenings)
            ),
            'comments' => $this->whenLoaded(
                'comments',
                fn () => CommentResource::collection($this->resource->comments)
            ),
            'scores' => $this->whenLoaded(
                'scores',
                fn () => ScoreResource::collection($this->resource->scores)
            ),
            'agents' => $this->whenLoaded(
                'agents',
                fn () => AgentResource::collection($this->resource->agents)
            ),
            'image' => $this->when(
                $this->resource->getFirstMediaUrl('image'),
                $this->resource->getFirstMediaUrl('image')
            )

        ];
    }
}
