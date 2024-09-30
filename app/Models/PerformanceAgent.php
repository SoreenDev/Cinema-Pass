<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerformanceAgent extends Model
{
    use HasFactory;
    protected $table = 'performance_agents';
    protected $fillable = ['activity', 'exception','performance_id','agent_id'];

    public function performance() :BelongsTo
    {
        return $this->belongsTo(Performance::class);
    }
}
