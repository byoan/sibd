@extends('layouts.app')

@section('content')

<h1>Create Ad</h1>
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

<form action="/ads" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="nomAd">Nom Ad</label>
        <input required class="form-control" id="nomAd" name="nomAd" placeholder="Enter a name for the ad" value={{ old('nomAd') }}>
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input required class="form-control" id="title" name="title" placeholder="Enter a title for the ad" value={{ old('title') }}>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
    </div>
    <div class="form-group">
        <label for="picture">Picture URL</label>
        <input required class="form-control" id="picture" name="picture" placeholder="Enter the URL of the image associated to the ad" value={{ old('picture') }}>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
