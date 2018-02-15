@extends('layouts.app')

@section('content')

<h1>Ad #{{ $ad->id }} edition</h1>
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

<form action="/ads/{{ $ad->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="nomAd">Ad name</label>
        <input required class="form-control" id="nomAd" name="nomAd" placeholder="Enter a name for the ad" value={{ $ad->nomAd }}>
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input required class="form-control" id="title" name="title" placeholder="Enter a title for the ad" value={{ $ad->title }}>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control">{{ $ad->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="picture">Picture URL</label>
        <input required class="form-control" id="picture" name="picture" placeholder="Enter the URL of the image associated to the ad" value={{ $ad->picture }}>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
