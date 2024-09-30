<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'long_description', 'activity'] ;

    public function performanceAgent(): HasMany
    {
        return $this->hasMany(PerformanceAgent::class);
    }

    public function performances(): BelongsToMany
    {
        return $this->belongsToMany(Performance::class,'performance_agents');
    }
}
