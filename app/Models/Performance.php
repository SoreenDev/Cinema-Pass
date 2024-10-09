<?php

namespace App\Models;

use App\Trait\HasComments;
use App\Trait\HasScores;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Performance extends Model implements HasMedia
{
    use HasFactory, HasScores, HasComments, InteractsWithMedia;

    protected $fillable = ['name', 'duration', 'age_group', 'description', 'price', 'production_data','category_id'];

    public function scores(): MorphMany
    {
        return $this->morphMany(Score::class, 'score_able');
    }

    public function performanceAgent(): HasMany
    {
        return $this->hasMany(PerformanceAgent::class);
    }

    public function dailyScreenings(): HasMany
    {
        return $this->hasMany(DailyScreenings::class);
    }

    public function agents(): BelongsToMany
    {
        return $this->belongsToMany(Agent::class, "performance_agents")
            ->withPivot(["activity", "exception"]);
    }
}
