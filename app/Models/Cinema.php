<?php

namespace App\Models;

use App\Trait\HasComment;
use App\Trait\HasScore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cinema extends Model
{
    use HasFactory, HasComment ,HasScore;

    protected $fillable= [
        'name',
        'address',
        'location',
        'description',
        'phone',
        'entry_fee',
        'city_id'
    ] ;


    public function daily_screenings() :HasMany
    {
        return $this->hasMany(DailyScreenings::class);
    }



}
