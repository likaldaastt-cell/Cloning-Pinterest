@extends('layouts.app')
@section('title', 'Edit board')
@section('content')
<div class='card'>
    <h2>Edit board</h2>
    @include('boards._form', ['action' => route('boards.update', $board), 'board' => $board])
</div>
@endsection