@extends('layouts.app')

@section('content')
    <h1>{{ $user->name }}</h1>

    <ul class="nav nav-tabs nav-justified mt-4 mb-4">
        <li class="nav-item">
            <a href="{{ route('users.show', $user) }}" class="nav-link {{ request()->routeIs('users.show') ? 'active' : '' }}">
                動画 <span class="badge text-bg-secondary">{{ $user->movies_count }}</span>
            </a>
        </li>
        {{-- ここから追記 --}}
        <li class="nav-item">
            <a href="{{ route('users.favorites', $user) }}" class="nav-link {{ request()->routeIs('users.favorites') ? 'active' : '' }}">
                お気に入り <span class="badge text-bg-secondary">{{ $user->favorites_count }}</span>
            </a>
        </li>
        {{-- ここまで追記 --}}
    </ul>

    @include('movies.movies', ['movies' => $movies])
@endsection
