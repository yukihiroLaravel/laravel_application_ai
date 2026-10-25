<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @foreach ($movies as $movie)
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-end mb-2">
                        いいね！ <span class="badge rounded-pill text-bg-success">{{ $movie->favorite_users_count }}</span>
                    </div>
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/{{ $movie->youtube_id }}" allowfullscreen></iframe>
                    </div>
                    <p class="mt-2">{{ $movie->displayTitle() }}</p>

                    @include('favorite.favorite_button', ['movie' => $movie])

                    @if (Auth::id() === $movie->user_id)
                        <div class="d-flex justify-content-between">
                            <form method="POST" action="{{ route('movies.destroy', $movie) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">この動画を削除する</button>
                            </form>
                            <a href="{{ route('movies.edit', $movie) }}" class="btn btn-primary btn-sm">編集する</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-4">
    {{ $movies->links() }}
</div>
