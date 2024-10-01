<?php

namespace App\Trait;

use App\Models\Score;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasScore
{
    public function scores(): MorphMany
    {
        return $this->morphMany(Score::class, 'score_able');
    }
}
