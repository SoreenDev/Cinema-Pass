<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTicket extends Model
{
    protected $fillable = ['user_id', 'daily_screenings_id', 'status_payment'] ;
}
