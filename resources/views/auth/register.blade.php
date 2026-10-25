@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h2>新規ユーザ登録</h2>
        <p class="mt-3">新規ユーザ登録すると、動画の登録などができるようになります。</p>
    </div>

    <div class="row mt-4 mb-5">
        <div class="col-sm-6 offset-sm-3">
            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">名前</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">メールアドレス</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">パスワード</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">パスワード確認</label>
                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                </div>

                <button type="submit" class="btn btn-primary mt-2">新規登録</button>
            </form>
        </div>
    </div>
@endsection
