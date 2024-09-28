<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyScreenings extends Model
{
    protected $fillable = ['city_id', 'cinema_id', 'performance_id', 'start_time', 'final_ticket_cost'];
}
