@extends('layouts.app')

@section('content')

<h1>Horse-Attribute relation details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Horse-Attribute relation id : {{ $att->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('horseatts.edit', $att->id) }}">Edit</a>
        <form method="POST" action="{{ route('horseatts.destroy', $att->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $att->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <p>Horse : <a href="/horses/{{ $att->idHorse }}" title="Go to the horse details">{{ $att->idHorse }}</a></p>
    <p>Attribute : <a href="/atts/{{ $att->idAtt }}" title="Go to the attribute details">{{ $att->idAtt }}</a></p>
</div>
@endsection
