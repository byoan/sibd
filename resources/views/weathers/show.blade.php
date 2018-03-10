@extends('layouts.app')

@section('content')

<h1>Weather details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Weather id : {{ $weather->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('weathers.edit', $weather->id) }}">Edit</a>
        <form method="POST" action="{{ route('weathers.destroy', $weather->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $weather->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations : </h3>
    <p>Weather type : {{ $weather->typeWeather }}</h3>
    <p>Title : {{ $weather->title }}</h3>
    <p>Description : {{ $weather->description }}</h3>
    <p>Picture :</p>
    <img src="{{ $weather->picture }}" />
</div>
@endsection
