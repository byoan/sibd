@extends('layouts.app')

@section('content')

<h1>News details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>News type : {{ $news->typeNews }} (#{{ $news->id }})</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('news.edit', $news->id) }}">Edit</a>
        <form method="POST" action="{{ route('news.destroy', $news->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $news->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<h2>Title : {{ $news->title }}</h2>
<br />
<div>
    <h3>Informations</h3>
    <p>Description : {{ $news->description }}</p>
    <p>Picture : <img src="{{ $news->picture }}" alt={{ $news->title }} /></p>
</div>
@endsection
