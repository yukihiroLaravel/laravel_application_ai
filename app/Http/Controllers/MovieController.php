<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    // 動画登録画面
    public function create(Request $request)
    {
        $movies = $request->user()->movies()->withCount('favoriteUsers')->latest()->paginate(9);

        return view('movies.create', [
            'movies' => $movies,
        ]);
    }

    // 動画を登録する
    public function store(MovieRequest $request)
    {
        $request->user()->movies()->create([
            'youtube_id' => $request->youtube_id,
            'title' => $request->title,
            'favorite_flag' => $request->boolean('favorite_flag'),
        ]);

        return back();
    }

    // 動画編集画面
    public function edit(Request $request, Movie $movie)
    {
        abort_if($movie->user_id !== $request->user()->id, 403);

        $movies = $request->user()->movies()->withCount('favoriteUsers')->latest()->paginate(9);

        return view('movies.edit', [
            'movie' => $movie,
            'movies' => $movies,
        ]);
    }

    // 動画を更新する
    public function update(MovieRequest $request, Movie $movie)
    {
        abort_if($movie->user_id !== $request->user()->id, 403);

        $movie->update([
            'youtube_id' => $request->youtube_id,
            'title' => $request->title,
            'favorite_flag' => $request->boolean('favorite_flag'),
        ]);

        return back();
    }

    // 動画を削除する
    public function destroy(Request $request, Movie $movie)
    {
        // 自分の動画でなければ「権限がありません（403）」
        abort_if($movie->user_id !== $request->user()->id, 403);

        $movie->delete();

        return back();
    }
}
