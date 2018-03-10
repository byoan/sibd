@extends('layouts.app')

@section('content')

<h1>Create Weather List</h1>
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

<form action="/weatherlists" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="idNewspaper">Id Newspaper</label>
        <input required type="number" step="1" class="form-control" id="idNewspaper" name="idNewspaper" placeholder="Enter the id in which newspaper the weather is in" value={{ old('idNewspaper') }}>
    </div>
    <div class="form-group">
        <label for="idWeather">Id Weather</label>
        <input required type="number" step="1" class="form-control" id="idWeather" name="idWeather" placeholder="Enter the weather id concerned by this association" value={{ old('idWeather') }}>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
