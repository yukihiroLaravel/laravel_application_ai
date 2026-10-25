<header class="mb-5">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">YouTubeまとめ×コミュニケーション</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav-bar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav-bar">
                <ul class="navbar-nav ms-auto align-items-sm-center">
                    @auth
                        <li class="nav-item"><a href="{{ route('movies.create') }}" class="nav-link">動画を登録する</a></li>
                        <li class="nav-item"><a href="{{ route('users.show', Auth::user()) }}" class="nav-link">マイページ</a></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">ログアウト</button>
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">ログイン</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">新規ユーザ登録</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>

@auth
    <p class="text-end me-3">ユーザー：<span class="fw-bold">{{ Auth::user()->name }}</span></p>
@endauth
