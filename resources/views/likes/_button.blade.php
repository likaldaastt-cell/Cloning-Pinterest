@php
    $liked = (bool) ($pin->liked_by_me ?? false);
    $count = $pin->likes_count ?? $pin->likedBy()->count();
@endphp

@auth
    <form method="POST" action="{{ $liked ? route('pins.unlike', $pin) : route('pins.like', $pin) }}" class="inline">
        @csrf
        @if ($liked)
            @method('DELETE')
        @endif
        <button type="submit" aria-pressed="{{ $liked ? 'true' : 'false' }}">
            {{ $liked ? 'Unlike' : 'Like' }} ({{ $count }})
        </button>
    </form>
@else
    <span>Likes ({{ $count }})</span>
@endauth