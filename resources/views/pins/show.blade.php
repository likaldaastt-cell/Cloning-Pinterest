@extends('layouts.app')
@section('title', $pin->title)
@section('content')
<div class='card' style='max-width:640px'>
    <img src='{{ $pin->image_url }}' alt='{{ $pin->title }}' style='width:100%; border-radius:12px'>
    <h2>{{ $pin->title }}</h2>
    <p>{{ $pin->description }}</p>
    <p class='muted'>
        oleh <a href='{{ url('/users/' . $pin->user_id) }}'>{{ $pin->user->name }}</a>
        · board {{ $pin->board->name }}
        @if ($pin->category) · {{ $pin->category }} @endif
    </p>
    @includeIf('likes._button', ['pin' => $pin])
    @can('update', $pin)
        <p>
            <a class='btn btn-light' href='{{ route('pins.edit', $pin) }}'>Edit</a>
            <form method='POST' action='{{ route('pins.destroy', $pin) }}' class='inline'
                  onsubmit='return confirm("Hapus pin ini?")'>
                @csrf @method('DELETE')
                <button type='submit'>Hapus</button>
            </form>
        </p>
    @endcan
</div>
@endsection
