@extends('layouts.app')

@section('content')

<h1>Weather list #{{ $weatherList->id }} edition</h1>
<hr />

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/weatherlists/{{ $weatherList->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="idNewspaper">Id Newspaper</label>
        <input required class="form-control" id="idNewspaper" name="idNewspaper" placeholder="Enter a newspaper id" value={{ $weatherList->idNewspaper }}>
    </div>
    <div class="form-group">
        <label for="idWeather">Id Weather</label>
        <input required class="form-control" id="idWeather" name="idWeather" placeholder="Enter a weather id" value={{ $weatherList->idWeather }}>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
