@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class='card'>
    <h2>Masuk</h2>
    <form method='POST' action='{{ route('login') }}'>
        @csrf
        <label>Email</label>
        <input type='email' name='email' value='{{ old('email') }}' required>
        <label>Password</label>
        <input type='password' name='password' required>
        <p><label><input type='checkbox' name='remember' value='1' style='width:auto'> Ingat saya</label></p>
        <button type='submit'>Masuk</button>
    </form>
    <p class='muted'>Belum punya akun? <a href='{{ route('register') }}'>Daftar</a></p>
</div>
@endsection