@extends('layouts.app')

@section('content')

<h1>Ad details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Ad name : {{ $ad->nomAd }} (#{{ $ad->id }})</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('ads.edit', $ad->id) }}">Edit</a>
        <form method="POST" action="{{ route('ads.destroy', $ad->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $ad->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<h2>Title : {{ $ad->title }}</h2>
<br />
<div>
    <h3>Informations</h3>
    <p>Description : {{ $ad->description }}</p>
    <p>Picture : <img src="{{ $ad->picture }}" alt={{ $ad->title }} /></p>
</div>
@endsection
