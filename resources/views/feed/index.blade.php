<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed</title>
</head>
<body>
    <h1>Feed</h1>

    <div>
        <a href="{{ route('feed.index') }}">Semua</a>
        @foreach ($categories as $category)
            <a href="{{ route('feed.index', ['category' => $category]) }}"
               @if ($active === $category) aria-current="page" @endif>
                {{ $category }}
            </a>
        @endforeach
    </div>

    <div>
        @forelse ($pins as $pin)
            <article>
                <h2>{{ $pin->title ?? 'Pin #' . $pin->id }}</h2>
                @if (!empty($pin->image_url))
                    <img src="{{ $pin->image_url }}" alt="{{ $pin->title ?? 'Pin' }}">
                @endif
                @if (!empty($pin->category))
                    <p>Kategori: <a href="{{ route('feed.index', ['category' => $pin->category]) }}">{{ $pin->category }}</a></p>
                @endif
                @include('likes._button', ['pin' => $pin])
            </article>
        @empty
            <p>Belum ada pin.</p>
        @endforelse
    </div>

    <div>
        {{ $pins->links() }}
    </div>
</body>
</html>