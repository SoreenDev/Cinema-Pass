<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyScreenings extends Model
{
    protected $fillable = ['city_id', 'cinema_id', 'performance_id', 'start_time', 'final_ticket_cost'];

    public function city() : BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function Cinema() : BelongsTo
    {
        return $this->belongsTo(Cinema::class);
    }

    public function performance() : BelongsTo
    {
        return $this->belongsTo(Performance::class);
    }
}
