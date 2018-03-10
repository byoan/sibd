@extends('layouts.app')

@section('content')

<h1>Weather list details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Weather list id : {{ $weatherList->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('weatherlists.edit', $weatherList->id) }}">Edit</a>
        <form method="POST" action="{{ route('weatherlists.destroy', $weatherList->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $weatherList->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <p>Id Newspaper :  <a href="{{ route('newspapers.show', $weatherList->idNewspaper)}}" title="See the newspaper details">{{ $weatherList->idNewspaper }}</a></p></p>
    <p>Id Weather : <a href="{{ route('weathers.show', $weatherList->idWeather)}}" title="See the weather details">{{ $weatherList->idWeather }}</a></p>
</div>
@endsection
