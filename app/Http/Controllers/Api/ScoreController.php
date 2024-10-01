<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScoreResource;
use App\Models\Score;
use Spatie\QueryBuilder\QueryBuilder;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scores = QueryBuilder::for(Score::class)
            ->allowedIncludes('score_able')
            ->get();

        return $this->successResponseWithAdditional(
            ScoreResource::collection($scores),
            'All Scores'
        );
    }


    /**
     * Display the specified resource.
     */
    public function show(Score $score)
    {
        return $this->successResponse(
            ScoreResource::make($score->load('score_able')),
            'Successfully find score'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Score $score)
    {
        $score->delete();

        return $this->successResponse(message: 'Successfully deleted score');
    }


}
