<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// トップページ（ユーザー一覧）
Route::get('/', [UserController::class, 'index'])->name('home');

// ユーザー詳細
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

// ログインしている人だけが使えるページ
Route::middleware('auth')->group(function () {
    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');
});
