@extends('layouts.app')
@section('title', 'Pin baru')
@section('content')
<div class='card'>
    <h2>Pin baru</h2>
    @if ($boards->isEmpty())
        <p>Kamu belum punya board. <a href='{{ route('boards.create') }}'>Buat board dulu</a>.</p>
    @else
        @include('pins._form', ['action' => route('pins.store'), 'pin' => null])
    @endif
</div>
@endsection