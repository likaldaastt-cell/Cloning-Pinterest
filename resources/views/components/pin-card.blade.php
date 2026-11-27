@props(['pin'])

<article class='pin'>
    <a href='{{ url('/pins/' . $pin->id) }}'>
        <img src='{{ $pin->image_url }}' alt='{{ $pin->title }}' loading='lazy'>
    </a>
    <div class='pin-body'>
        <strong>{{ $pin->title }}</strong>
        <div class='muted'>
            oleh <a href='{{ url('/users/' . $pin->user_id) }}'>{{ $pin->user->name }}</a>
            @if ($pin->category) · <a href='{{ url('/feed?category=' . urlencode($pin->category)) }}'>{{ $pin->category }}</a> @endif
        </div>
        
        {{-- Ini bakal muncul kalau Orang 4 udah bikin tombol like --}}
        @includeIf('likes._button', ['pin' => $pin])
    </div>
</article>