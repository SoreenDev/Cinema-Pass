<?php

namespace App\Http\Resources;

use App\Models\Cinema;
use App\Models\Comment;
use App\Models\Performance;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'body' => $this->resource->body,
            'user' => $this->whenLoaded(
                'user',
                fn() => $this->resource->user,
                $this->resource->user_id
            ),
            'resource'=> $this->whenLoaded(
                'commentable',
                function ()
                {
                    if ($this->resource->commentable instanceof Cinema)
                        return CinemaResource::make($this->resource->commentable);
                    if ($this->resource->commentable instanceof Performance)
                        return PerformanceResource::make($this->resource->commentable);
                    if ($this->resource->commentable instanceof Comment)
                        return CommentResource::make($this->resource->commentable);
                }
            )
        ];
    }
}
