@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h2>ログイン</h2>
        <p class="mt-3">ログインすると、動画の登録などができるようになります。</p>
    </div>

    <div class="row mt-4 mb-5">
        <div class="col-sm-6 offset-sm-3">
            <form method="POST" action="{{ route('login.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">メールアドレス</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">パスワード</label>
                    <input id="password" type="password" class="form-control" name="password">
                </div>
                <button type="submit" class="btn btn-primary mt-2">ログイン</button>
            </form>

            <div class="mt-3"><a href="{{ route('register') }}">新規ユーザ登録する？</a></div>
        </div>
    </div>
@endsection
