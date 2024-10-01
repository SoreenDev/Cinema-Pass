<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Score extends Model
{
    use HasFactory;

    protected $fillable = ['score_able_id', 'score_able_type', 'point', 'user_id'] ;

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function score_able() :MorphTo
    {
        return $this->morphTo();
    }
}
