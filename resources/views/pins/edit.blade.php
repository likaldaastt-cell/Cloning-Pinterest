@extends('layouts.app')
@section('title', 'Edit pin')
@section('content')
<div class='card'>
    <h2>Edit pin</h2>
    @include('pins._form', ['action' => route('pins.update', $pin), 'pin' => $pin])
</div>
@endsection