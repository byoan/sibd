@extends('layouts.app')

@section('content')

<h1>Injury association details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Injury association id : {{ $injury->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('injurieslists.edit', $injury->id) }}">Edit</a>
        <form method="POST" action="{{ route('injurieslists.destroy', $injury->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $injury->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <p>Targeted horse : <a href="{{ route('horses.show', $injury->idHorse) }}" title="See horse details">{{ $injury->idHorse }}</a></p>
    <p>Targeted injury : <a href="{{ route('injuries.show', $injury->idInjury) }}" title="See injury details">{{ $injury->idInjury }}</a></p>
</div>
@endsection
