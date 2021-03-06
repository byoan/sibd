@extends('layouts.app')

@section('content')

<h1>Create Horse</h1>
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

<form action="/horses" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Horse name</label>
        <input required class="form-control" id="name" name="name" placeholder="Enter an horse name" value="{{ old('name') }}">
    </div>
    <div class="form-group">
        <label for="race">Horse race</label>
        <input required class="form-control" id="race" minlength="1" maxlength="100" name="race" placeholder="Enter an horse race" value="{{ old('race') }}">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea required class="form-control" id="description" name="description" placeholder="Enter an horse description">{{ old('description') }}</textarea>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input required class="form-control" id="price" type="number" step="0.01" minlength="1" maxlength="100" name="price" placeholder="Enter an horse price" value="{{ old('price') }}">
    </div>
    <div class="form-group">
        <label for="experience">Horse experience</label>
        <input required class="form-control" id="experience" type="number" step="1" minlength="1" maxlength="100" name="experience" placeholder="Enter the experience" value="{{ old('experience') }}">
    </div>
    <div class="form-group">
        <label for="level">Horse level</label>
        <input required class="form-control" id="level" type="number" step="1" minlength="1" maxlength="100" name="level" placeholder="Enter an horse level" value="{{ old('level') }}">
    </div>
    <div class="form-group">
        <label for="generalLevel">Horse general Level</label>
        <input required class="form-control" type="number" step="1" minlength="1" maxlength="100" id="generalLevel" name="generalLevel" placeholder="Enter the horse general level">{{ old('generalLevel') }}</textarea>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
