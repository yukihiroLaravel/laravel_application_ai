@extends('layouts.app')

@section('content')
    <h2 class="mt-4">動画を編集する</h2>

    <form method="POST" action="{{ route('movies.update', $movie) }}" class="mt-4">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="youtube_id" class="form-label text-success">YouTube動画の「ID」を入力する</label>
            <p class="small">
                例）登録したい動画のURLが https://www.youtube.com/watch?v=<span class="text-success fw-bold">-bNMq1Nxn5o</span> なら、
                「v=」のあとの <span class="text-success fw-bold">-bNMq1Nxn5o</span> を入力
            </p>
            <input id="youtube_id" type="text" class="form-control @error('youtube_id') is-invalid @enderror" name="youtube_id" value="{{ old('youtube_id', $movie->youtube_id) }}">
            @error('youtube_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">動画タイトル（任意）</label>
            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $movie->title) }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-check mb-3">
            {{-- チェックを外したときも「0」が送られるようにする --}}
            <input type="hidden" name="favorite_flag" value="0">
            <input id="favorite_flag" type="checkbox" class="form-check-input" name="favorite_flag" value="1" @checked(old('favorite_flag', $movie->favorite_flag))>
            <label for="favorite_flag" class="form-check-label">いいね！を許可する</label>
        </div>
        <button type="submit" class="btn btn-primary">更新する</button>
    </form>

    <h2 class="mt-5 mb-4">あなたの登録済み動画</h2>
    @include('movies.movies', ['movies' => $movies])
@endsection
