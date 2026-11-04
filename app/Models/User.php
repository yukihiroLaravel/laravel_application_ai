<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany; // 追記
use Illuminate\Database\Eloquent\Relations\HasOne; // 追記
use Illuminate\Database\Eloquent\SoftDeletes; // 追記
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes; // SoftDeletes を追記

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

    // 追記ここから
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
    // 追記ここまで
}
