@extends('layouts.app')

@section('content')

<h1>News relation details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>News relation id : {{ $newsList->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('newslists.edit', $newsList->id) }}">Edit</a>
        <form method="POST" action="{{ route('newslists.destroy', $newsList->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $newsList->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <p>Id Newspaper :  <a href="{{ route('newspapers.show', $newsList->idNewspaper)}}" title="See the newspaper details">{{ $newsList->idNewspaper }}</a></p></p>
    <p>Id News : <a href="{{ route('news.show', $newsList->idNews)}}" title="See the news details">{{ $newsList->idNews }}</a></p>
</div>
@endsection
