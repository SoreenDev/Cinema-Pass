<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class CommentController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum'),
        ];
    }
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
        return $this->successResponse(message: 'Successfully delete comment');
    }

    public function givingScore(Comment $comment)
    {
        $UserLastScore = $comment->scores()->where('user_id', auth()->id())->first();
        if (! is_null($UserLastScore)) {

            $UserLastScore->delete();
            $message = "Deleted comment score";

        }else{

            $comment->scores()->create([
                'user_id' => auth()->id(),
            ]);
            $message = "add comment score";

        }

        return $this->successResponse(
            CommentResource::make($comment->load(['commentable','user','scores'])),
            message: $message
        );
    }
}
