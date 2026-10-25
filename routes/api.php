<?php

use App\Http\Controllers\Api\MovieController;
use Illuminate\Support\Facades\Route;

// /api/movies で始まる5つのAPI（index, store, show, update, destroy）
Route::apiResource('movies', MovieController::class)->names('api.movies');
