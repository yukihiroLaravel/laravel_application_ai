<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // このユーザーが登録した動画（1人のユーザーは複数の動画を持つ）
    public function movies(): HasMany
    {
        return $this->hasMany(Movie::class);
    }

    // このユーザーが最後に登録した動画（トップページで1つだけ表示する用）
    public function latestMovie(): HasOne
    {
        return $this->hasOne(Movie::class)->latestOfMany();
    }

    // このユーザーがいいねした動画（多対多）
    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'favorites')->withTimestamps();
    }

    // このユーザーの動画が受け取ったいいね（合計いいね数を数える用）
    public function receivedFavorites(): HasManyThrough
    {
        return $this->hasManyThrough(Favorite::class, Movie::class);
    }

    // その動画にいいねしているか
    public function isFavorite(Movie $movie): bool
    {
        return $this->favorites()->where('movie_id', $movie->id)->exists();
    }

    // いいねする（まだいいねしていなければ）
    public function favorite(Movie $movie): void
    {
        if (! $this->isFavorite($movie)) {
            $this->favorites()->attach($movie->id);
        }
    }

    // いいねを外す（いいねしていれば）
    public function unfavorite(Movie $movie): void
    {
        if ($this->isFavorite($movie)) {
            $this->favorites()->detach($movie->id);
        }
    }
}
