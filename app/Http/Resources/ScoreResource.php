<?php

namespace App\Http\Resources;

use App\Models\Cinema;
use App\Models\Comment;
use App\Models\Performance;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScoreResource extends JsonResource
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
          'point' => $this->resource->point ?? '',
          'resource'=> $this->whenLoaded(
                'score_able',
                function ()
                {
                    if ($this->resource->score_able instanceof Cinema)
                        return CinemaResource::make($this->resource->score_able);
                    if ($this->resource->score_able instanceof Performance)
                        return PerformanceResource::make($this->resource->score_able);
                    if ($this->resource->score_able instanceof Comment)
                        return CommentResource::make($this->resource->score_able);
                }
          )
        ];
    }
}
