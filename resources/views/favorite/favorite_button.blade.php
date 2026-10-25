@auth
    @if (Auth::id() !== $movie->user_id && $movie->favorite_flag)
        @if (Auth::user()->isFavorite($movie))
            <form method="POST" action="{{ route('favorites.destroy', $movie) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm">いいね！を外す</button>
            </form>
        @else
            <form method="POST" action="{{ route('favorites.store', $movie) }}">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">いいね！を押す</button>
            </form>
        @endif
    @endif
@endauth
