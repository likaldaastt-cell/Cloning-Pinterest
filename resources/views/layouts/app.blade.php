<!DOCTYPE html>
<html lang='id'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>@yield('title', 'PinClone')</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: system-ui, sans-serif; background: #fafafa; color: #222; }
        a { color: #c8102e; text-decoration: none; }
        .nav { display: flex; justify-content: space-between; align-items: center; padding: 12px 24px; background: #fff; box-shadow: 0 1px 4px #0001; position: sticky; top: 0; z-index: 5; }
        .nav-right { display: flex; gap: 16px; align-items: center; }
        .container { max-width: 1100px; margin: 24px auto; padding: 0 16px; }
        .masonry { column-width: 230px; column-gap: 16px; }
        .pin { break-inside: avoid; background: #fff; border-radius: 16px; margin-bottom: 16px; overflow: hidden; box-shadow: 0 1px 4px #0002; }
        .pin img { width: 100%; display: block; }
        .pin-body { padding: 10px 12px; font-size: 14px; }
        .card { background: #fff; padding: 20px; border-radius: 12px; max-width: 480px; margin: 0 auto; box-shadow: 0 1px 4px #0002; }
        label { display: block; margin: 12px 0 4px; font-weight: 600; }
        input, textarea, select { width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 8px; font: inherit; }
        button, .btn { background: #c8102e; color: #fff; border: 0; padding: 8px 16px; border-radius: 20px; cursor: pointer; font: inherit; display: inline-block; }
        .btn-light { background: #eee; color: #222; }
        .alert { padding: 10px 14px; border-radius: 8px; margin-bottom: 16px; }
        .alert-ok { background: #e6f6ea; }
        .alert-err { background: #fde8e8; }
        .inline { display: inline; }
        .muted { color: #777; font-size: 13px; }
        .pager { display: flex; gap: 16px; justify-content: center; margin: 24px 0; }
    </style>
</head>
<body>
<nav class='nav'>
    <a href='{{ url('/') }}'><strong>PinClone</strong></a>
    <div class='nav-right'>
        @auth
            @if (Route::has('pins.create')) <a href='{{ route('pins.create') }}'>+ Pin</a> @endif
            @if (Route::has('boards.index')) <a href='{{ route('boards.index') }}'>Board saya</a> @endif
            @if (Route::has('profile.show')) <a href='{{ route('profile.show', auth()->user()) }}'>{{ auth()->user()->name }}</a> @endif
            @if (Route::has('logout'))
                <form method='POST' action='{{ route('logout') }}' class='inline'>@csrf <button>Keluar</button></form>
            @endif
        @else
            @if (Route::has('login')) <a href='{{ route('login') }}'>Masuk</a> @endif
            @if (Route::has('register')) <a href='{{ route('register') }}'>Daftar</a> @endif
        @endauth
    </div>
</nav>

<main class='container'>
    @if (session('status')) <div class='alert alert-ok'>{{ session('status') }}</div> @endif
    @if ($errors->any())
        <div class='alert alert-err'>
            @foreach ($errors->all() as $error) <div>{{ $error }}</div> @endforeach
        </div>
    @endif

    @yield('content')
</main>
</body>
</html>