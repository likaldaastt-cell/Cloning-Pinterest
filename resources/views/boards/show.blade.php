@extends('layouts.app')
@section('title', $board->name)
@section('content')
<h2>{{ $board->name }}</h2>
<p class='muted'>{{ $board->description }} · oleh {{ $board->user->name }}</p>
<p>
    <a class='btn' href='{{ route('pins.create', ['board_id' => $board->id]) }}'>+ Pin</a>
    @can('update', $board)
        <a class='btn btn-light' href='{{ route('boards.edit', $board) }}'>Edit</a>
    @endcan
    @can('delete', $board)
        <form method='POST' action='{{ route('boards.destroy', $board) }}' class='inline'
              onsubmit='return confirm("Hapus board ini beserta semua pin di dalamnya?")'>
            @csrf @method('DELETE')
            <button type='submit'>Hapus</button>
        </form>
    @endcan
</p>
<div class='masonry'>
    @forelse ($board->pins as $pin)
        <x-pin-card :pin='$pin' />
    @empty
        <p class='muted'>Board ini masih kosong.</p>
    @endforelse
</div>
@endsection