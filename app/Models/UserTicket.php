<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTicket extends Model
{
    protected $fillable = ['user_id', 'daily_screenings_id', 'status_payment', 'price'] ;

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function daily_screening() : BelongsTo
    {
        return $this->belongsTo(DailyScreenings::class, 'daily_screenings_id');
    }
    public function performance() : BelongsTo
    {
        return $this->belongsTo(Performance::class);
    }

}
