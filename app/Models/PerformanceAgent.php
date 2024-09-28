<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceAgent extends Model
{
    use HasFactory;
    protected $table = 'performance_agents';
    protected $fillable = ['activity', 'exception','performance_id','agent_id'];
}
