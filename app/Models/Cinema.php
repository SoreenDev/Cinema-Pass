<?php

namespace App\Models;

use App\Trait\HasComment;
use App\Trait\HasScore;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Cinema extends Model implements HasMedia
{
    use HasFactory, HasComment, HasScore , InteractsWithMedia;

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

    public function city() :BelongsTo
    {
        return $this->belongsTo(City::class);
    }

}
