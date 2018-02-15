@extends('layouts.app')

@section('content')

<h1>Disease #{{ $disease->id }} edition</h1>
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

<form action="/diseases/{{ $disease->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="typeDisease">Disease type</label>
        <input required class="form-control" id="typeDisease" name="typeDisease" placeholder="Enter a disease name" value={{ $disease->typeDisease }}>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control">{{ $disease->description }}</textarea>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
