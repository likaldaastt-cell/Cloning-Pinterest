@extends('layouts.app')

@section('title', 'Edit profil')

@section('content')
<div class='card'>
    <h2>Edit profil</h2>
    <form method='POST' action='{{ route('profile.update') }}'>
        @csrf
        @method('PUT')
        
        <label>Nama</label>
        <input type='text' name='name' value='{{ old('name', $user->name) }}' required>
        
        <label>Bio</label>
        <textarea name='bio' rows='3'>{{ old('bio', $user->bio) }}</textarea>
        
        <label>URL foto profil</label>
        <input type='url' name='photo_url' value='{{ old('photo_url', $user->photo_url) }}'>
        
        <p><button type='submit'>Simpan</button></p>
    </form>
</div>
@endsection