<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable= [
        'name',
        'address',
        'facilities_id',
        'location',
        'description',
        'phone',
        'entry_fee'
    ] ;

    public function facility() :BelongsTo
    {
        return $this->belongsTo(Facilities::class);
    }
    public function daily_screenings() :BelongsTo
    {
        return $this->belongsTo(DailyScreenings::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function scores(): MorphMany
    {
        return $this->morphMany(Score::class, 'score_able');
    }

}
