<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Performance extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'duration', 'age_group', 'description', 'price', 'production_data'] ;

    public function comments() :MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function scores() :MorphMany
    {
        return $this->morphMany(Score::class, 'score_able');
    }
}
