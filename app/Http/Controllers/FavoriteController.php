<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // いいねする
    public function store(Request $request, Movie $movie)
    {
        // 自分の動画・いいねが許可されていない動画にはいいねできない
        abort_if($movie->user_id === $request->user()->id || ! $movie->favorite_flag, 403);

        $request->user()->favorite($movie);

        return back();
    }

    // いいねを外す
    public function destroy(Request $request, Movie $movie)
    {
        $request->user()->unfavorite($movie);

        return back();
    }
}
