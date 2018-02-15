@extends('layouts.app')

@section('content')

<h1>Auto Task details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Task id : {{ $autoTask->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('autotasks.edit', $autoTask->id) }}">Edit</a>
        <form method="POST" action="{{ route('autotasks.destroy', $autoTask->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $autoTask->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <p>Action : {{ $autoTask->action }}</p>
    <p>Frequency : {{ $autoTask->frequency }}</p>
    <p>Owner : <a href="{{ route('users.show', $autoTask->user->id) }}" title="{{ $autoTask->user->username }}">{{ $autoTask->user->username }}</a></p>
    <p>Target : {{ $autoTask->idObject }}</p>
        {{--  <a href="{{ route('items.show', $autoTask->idObject) }}" title="Target"></a></p>  --}}
</div>
@endsection
