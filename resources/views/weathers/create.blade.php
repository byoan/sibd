@extends('layouts.app')

@section('content')

<h1>Create Weather</h1>
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

<form action="/weathers" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="typeWeather">Weather type</label>
        <input required class="form-control" id="typeWeather" name="typeWeather" placeholder="Enter a weather type" value="{{ old('typeWeather') }}">
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input required class="form-control" id="title" name="title" placeholder="Enter a title" value="{{ old('title') }}">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea required class="form-control" id="description" name="description" placeholder="Enter a description">{{ old('description') }}</textarea>
    </div>
    <div class="form-group">
        <label for="picture">Picture URL</label>
        <input required class="form-control" type="url" id="picture" name="picture" placeholder="Enter a picture URL" value="{{ old('picture') }}">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
