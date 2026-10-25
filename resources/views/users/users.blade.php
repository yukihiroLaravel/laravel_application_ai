<h2 class="mt-5 mb-4">チャンネル一覧</h2>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @foreach ($users as $user)
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <a href="{{ route('users.show', $user) }}">＠{{ $user->name }}</a>

                    @if ($user->latestMovie)
                        <div class="ratio ratio-16x9 mt-2">
                            <iframe src="https://www.youtube.com/embed/{{ $user->latestMovie->youtube_id }}" allowfullscreen></iframe>
                        </div>
                        <p class="mt-2 mb-0">{{ $user->latestMovie->title }}</p>
                    @else
                        <p class="text-muted mt-2 mb-0">動画はまだ登録されていません</p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-4">
    {{ $users->links() }}
</div>
