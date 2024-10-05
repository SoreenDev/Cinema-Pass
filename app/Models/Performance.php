<?php

namespace App\Models;

use App\Trait\HasComment;
use App\Trait\HasScore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Performance extends Model
{
    use HasFactory, HasScore, HasComment;

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
