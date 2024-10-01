<?php

namespace App\Models;

use App\Trait\HasComment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory, HasComment;

    protected $fillable = ['body','user_id'];

    public function scores() :MorphMany
    {
        return $this->morphMany(Score::class, 'score_able');
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function commentable() :MorphTo
    {
        return $this->morphTo();
    }
}
