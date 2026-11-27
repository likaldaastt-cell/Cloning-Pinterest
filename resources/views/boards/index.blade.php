@extends('layouts.app')
@section('title', 'Board saya')
@section('content')
<div style='display:flex; justify-content:space-between; align-items:center'>
    <h2>Board saya</h2>
    <a class='btn' href='{{ route('boards.create') }}'>+ Board baru</a>
</div>
<div style='display:grid; grid-template-columns:repeat(auto-fill, minmax(220px, 1fr)); gap:16px; margin-top:16px'>
    @forelse ($boards as $board)
        <a class='card' style='max-width:none; color:inherit' href='{{ route('boards.show', $board) }}'>
            <strong>{{ $board->name }}</strong>
            <div class='muted'>{{ $board->pins_count }} pin</div>
        </a>
    @empty
        <p class='muted'>Belum ada board. Buat board pertama kamu.</p>
    @endforelse
</div>
@endsection