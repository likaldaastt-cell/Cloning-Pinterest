@extends('layouts.app')
@section('title', 'Board baru')
@section('content')
<div class='card'>
    <h2>Board baru</h2>
    @include('boards._form', ['action' => route('boards.store'), 'board' => null])
</div>
@endsection