<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @foreach ($movies as $movie)
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/{{ $movie->youtube_id }}" allowfullscreen></iframe>
                    </div>
                    <p class="mt-2">{{ $movie->title }}</p>

                    {{-- 追記ここから --}}
                    @if (Auth::id() === $movie->user_id)
                        <form method="POST" action="{{ route('movies.destroy', $movie) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">この動画を削除する</button>
                        </form>
                    @endif
                    {{-- 追記ここまで --}}
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-4">
    {{ $movies->links() }}
</div>
