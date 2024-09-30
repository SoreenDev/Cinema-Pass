<?php

namespace App\Models;

use App\Trait\HasComment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Comment extends Model
{
    use HasFactory, HasComment;

    protected $fillable = ['commentable_id', 'commentable_type', 'body'];

    public function scores() :MorphMany
    {
        return $this->morphMany(Score::class, 'score_able');
    }
}
