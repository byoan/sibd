@extends('layouts.app')

@section('content')

<h1>Ad list details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Ad list id : {{ $ad->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('adslist.edit', $ad->id) }}">Edit</a>
        <form method="POST" action="{{ route('adslist.destroy', $ad->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $ad->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <p>Id Newspaper :  <a href="{{ route('newspapers.show', $ad->idNewspaper)}}" title="See the newspaper details">{{ $ad->idNewspaper }}</a></p></p>
    <p>Id Ad : <a href="{{ route('ads.show', $ad->idAd)}}" title="See the ad details">{{ $ad->idAd }}</a></p>
</div>
@endsection
