<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Comment::class);
        $comments = QueryBuilder::for(Comment::class)
            ->allowedIncludes('commentable','user','scores')
            ->get();
        return $this->successResponseWithAdditional(
            CommentResource::collection($comments),
            'All Comments'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return $this->successResponse(
            CommentResource::make($comment->load('commentable','user','scores')),
            'Successfully find Comment'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', Comment::class);
        $comment->delete();
        return $this->successResponse(message: "Successfully delete comment");
    }

    public function givingScore(Comment $comment)
    {
        $comment->scores()->create([
            'user_id' => auth()->id() ?? 1,
        ]);

        return $this->successResponse(
            CommentResource::make($comment->load(['commentable','user','scores'])),
            'Successfully Giving score'
        );
    }
}
