<?php

namespace App\Models;

use App\Trait\HasComment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Cinema extends Model
{
    use HasFactory;
    use HasComment;

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

    public function scores(): MorphMany
    {
        return $this->morphMany(Score::class, 'score_able');
    }

}
