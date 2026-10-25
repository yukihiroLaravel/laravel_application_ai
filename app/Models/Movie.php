<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['youtube_id', 'title'])]
class Movie extends Model
{
    use SoftDeletes;

    // この動画を登録したユーザー（動画は1人のユーザーに属する）
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
