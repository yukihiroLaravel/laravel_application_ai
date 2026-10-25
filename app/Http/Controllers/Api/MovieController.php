<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use App\Models\User;

class MovieController extends Controller
{
    // APIで登録・更新・削除する動画は、すべてこのユーザーの動画として扱う
    // （実務ではSanctumのトークン認証で「誰が操作したか」を判定します）
    private const API_USER_ID = 2;

    // 動画の一覧
    public function index()
    {
        $movies = Movie::latest()->get();

        return MovieResource::collection($movies);
    }

    // 動画を登録する
    public function store(MovieRequest $request)
    {
        $user = User::findOrFail(self::API_USER_ID);

        $movie = $user->movies()->create([
            'youtube_id' => $request->youtube_id,
            'title' => $request->title,
            'favorite_flag' => $request->boolean('favorite_flag'),
        ]);

        return (new MovieResource($movie))->response()->setStatusCode(201);
    }

    // 動画を1件取得する
    public function show(Movie $movie)
    {
        return new MovieResource($movie);
    }

    // 動画を更新する
    public function update(MovieRequest $request, Movie $movie)
    {
        abort_if($movie->user_id !== self::API_USER_ID, 403, 'この動画は更新できません。');

        $movie->update([
            'youtube_id' => $request->youtube_id,
            'title' => $request->title,
            'favorite_flag' => $request->boolean('favorite_flag'),
        ]);

        return new MovieResource($movie);
    }

    // 動画を削除する
    public function destroy(Movie $movie)
    {
        abort_if($movie->user_id !== self::API_USER_ID, 403, 'この動画は削除できません。');

        $movie->delete();

        return response()->json(['message' => '動画を削除しました。']);
    }
}
