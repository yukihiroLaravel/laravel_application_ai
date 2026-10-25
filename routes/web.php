<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// トップページ（ユーザー一覧）
Route::get('/', [UserController::class, 'index'])->name('home');

// ユーザー詳細
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/favorites', [UserController::class, 'favorites'])->name('users.favorites');

// ログインしている人だけが使えるページ
Route::middleware('auth')->group(function () {
    // 動画
    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
    Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('movies.update');
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');

    // いいね
    Route::post('/movies/{movie}/favorite', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/movies/{movie}/favorite', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});
