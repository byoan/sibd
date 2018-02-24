@extends('layouts.app')

@section('content')

<h1>Ad list #{{ $ad->id }} edition</h1>
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

<form action="/adslist/{{ $ad->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="idNewspaper">Id Newspaper</label>
        <input required class="form-control" id="idNewspaper" name="idNewspaper" placeholder="Enter a newspaper id" value={{ $ad->idNewspaper }}>
    </div>
    <div class="form-group">
        <label for="idAd">Id Ad</label>
        <input required class="form-control" id="idAd" name="idAd" placeholder="Enter an ad id" value={{ $ad->idAd }}>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
