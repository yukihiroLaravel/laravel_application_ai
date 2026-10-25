<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    // トップページ（ユーザー一覧）
    public function index()
    {
        $users = User::with('latestMovie')->latest('id')->paginate(9);

        return view('welcome', [
            'users' => $users,
        ]);
    }

    // ユーザー詳細
    public function show(User $user)
    {
        $user->loadCount('movies');
        $movies = $user->movies()->latest()->paginate(9);

        return view('users.show', [
            'user' => $user,
            'movies' => $movies,
        ]);
    }
}
