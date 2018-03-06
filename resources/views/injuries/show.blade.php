@extends('layouts.app')

@section('content')

<h1>Injury details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Injury id : {{ $injury->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('injuries.edit', $injury->id) }}">Edit</a>
        <form method="POST" action="{{ route('injuries.destroy', $injury->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $injury->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Injury name : {{ $injury->typeInjury }}</h3>
    <h3>Injury description : {{ $injury->description }}</h3>
</div>
@endsection
