@extends('layouts.app')

@section('title', $user->name)

@section('content')
<div style='text-align:center; margin-bottom:24px'>
    @if ($user->photo_url)
        <img src='{{ $user->photo_url }}' alt='{{ $user->name }}' style='width:96px;height:96px;border-radius:50%;object-fit:cover'>
    @endif
    <h2>{{ $user->name }}</h2>
    <p class='muted'>{{ $user->bio }}</p>
    <p class='muted'>{{ $user->boards_count }} board · {{ $user->pins_count }} pin</p>
    
    @auth
        @if (auth()->id() === $user->id)
            <a class='btn' href='{{ route('profile.edit') }}'>Edit profil</a>
        @endif
    @endauth
</div>

<div class='masonry'>
    @forelse ($pins as $pin)
        <x-pin-card :pin='$pin' />
    @empty
        <p class='muted'>Belum ada pin.</p>
    @endforelse
</div>
@endsection