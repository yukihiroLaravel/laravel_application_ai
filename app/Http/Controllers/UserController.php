<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    // トップページ（ユーザー一覧）
    public function index()
    {
        $users = User::with('latestMovie')
            ->withCount('receivedFavorites')
            ->latest('id')
            ->paginate(9);

        return view('welcome', [
            'users' => $users,
        ]);
    }

    // ユーザー詳細（登録した動画）
    public function show(User $user)
    {
        $user->loadCount(['movies', 'favorites']);
        $movies = $user->movies()->withCount('favoriteUsers')->latest()->paginate(9);

        return view('users.show', [
            'user' => $user,
            'movies' => $movies,
        ]);
    }

    // ユーザー詳細（いいねした動画）
    public function favorites(User $user)
    {
        $user->loadCount(['movies', 'favorites']);
        $movies = $user->favorites()->withCount('favoriteUsers')->latest('favorites.created_at')->paginate(9);

        return view('users.show', [
            'user' => $user,
            'movies' => $movies,
        ]);
    }
}
