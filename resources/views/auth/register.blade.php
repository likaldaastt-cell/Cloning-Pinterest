@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<div class="card">
    <h2>Daftar</h2>
    <form method='POST' action='{{ route('register') }}'>
        @csrf
        <label>Nama</label>
        <input type='text' name='name' value='{{ old('name') }}' required>
        <label>Email</label>
        <input type='email' name='email' value='{{ old('email') }}' required>
        <label>Password (min. 8 karakter)</label>
        <input type='password' name='password' required>
        <label>Ulangi password</label>
        <input type='password' name='password_confirmation' required>
        <p><button type='submit'>Daftar</button></p>
    </form>
    <p class='muted'>Sudah punya akun? <a href='{{ route('login') }}'>Masuk</a></p>
</div>
@endsection