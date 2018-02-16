@extends('layouts.app')

@section('content')

<h1>News #{{ $news->id }} edition</h1>
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

<form action="/news/{{ $news->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="typeNews">News type</label>
        <input required class="form-control" id="typeNews" name="typeNews" placeholder="Enter a news type" value={{ $news->typeNews }}>
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input required class="form-control" id="title" name="title" placeholder="Enter a title for the news" value={{ $news->title }}>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control">{{ $news->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="picture">Picture URL</label>
        <input required class="form-control" id="picture" name="picture" placeholder="Enter the URL of the image associated to the news" value={{ $news->picture }}>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
