@extends('layouts.app')

@section('content')

<h1>Create News relation</h1>
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

<form action="/newslists" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="idNewspaper">Id Newspaper</label>
        <input required type="number" step="1" class="form-control" id="idNewspaper" name="idNewspaper" placeholder="Enter the target newspaper id" value={{ old('idNewspaper') }}>
    </div>
    <div class="form-group">
        <label for="idNews">Id News</label>
        <input required type="number" step="1" class="form-control" id="idNews" name="idNews" placeholder="Enter the news to affect to the newspaper" value={{ old('idNews') }}>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
