<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['youtube_id', 'title', 'favorite_flag'])]
class Movie extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'favorite_flag' => 'boolean',
        ];
    }

    // この動画を登録したユーザー（動画は1人のユーザーに属する）
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // この動画にいいねしたユーザー（多対多）
    public function favoriteUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
}
