@extends('layouts.app')

@section('content')

<h1>Horse details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="horsesEditButtonRow">
    <h2>Horse id : {{ $horse->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('horses.edit', $horse->id) }}">Edit</a>
        <form method="POST" action="{{ route('horses.destroy', $horse->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $horse->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Indicator name : {{ $indicator->name }}</h3>
    <h3>Indicator value : {{ $indicator->value }}</h3>
</div>
@endsection
