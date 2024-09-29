<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Performance extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'duration', 'age_group', 'description', 'price', 'production_data','category_id'] ;

    public function comments() :MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function scores() :MorphMany
    {
        return $this->morphMany(Score::class, 'score_able');
    }

    public function performance_agent() :HasMany
    {
        return $this->hasMany(PerformanceAgent::class);
    }
    public function daily_screenings() :HasMany
    {
        return $this->hasMany(DailyScreenings::class);
    }
}
