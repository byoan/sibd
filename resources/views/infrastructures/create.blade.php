@extends('layouts.app')

@section('content')

<h1>Create Infrastructure</h1>
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

<form action="/infrastructures" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="type">Infrastructure type</label>
        <input required class="form-control" id="type" name="type" placeholder="Enter an infrastructure type" value="{{ old('type') }}">
    </div>
    <div class="form-group">
        <label for="level">Infrastructure level</label>
        <input required class="form-control" id="level" type="number" step="1" minlength="1" maxlength="100" name="level" placeholder="Enter an infrastructure level" value="{{ old('level') }}">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea required class="form-control" id="description" name="description" placeholder="Enter an infrastructure description">{{ old('description') }}</textarea>
    </div>
    <div class="form-group">
        <label for="family">Family</label>
        <input required class="form-control" id="family" name="family" placeholder="Enter an infrastructure family" value="{{ old('family') }}">
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input required class="form-control" id="price" type="number" step="0.001" name="price" placeholder="Enter an infrastructure price" value="{{ old('price') }}">
    </div>
    <div class="form-group">
        <label for="ressourcesConsumption">Resources consumption</label>
        <input required class="form-control" id="ressourcesConsumption" name="ressourcesConsumption" placeholder="Enter the resources consumed by this infrastructures, as words" value="{{ old('ressourcesConsumption') }}">
    </div>
    <div class="form-group">
        <label for="itemCapacity">Item capacity</label>
        <input required class="form-control" id="itemCapacity" type="number" step="1" minlength="1" maxlength="100" name="itemCapacity" placeholder="Enter an item capacity" value="{{ old('itemCapacity') }}">
    </div>
    <div class="form-group">
        <label for="horseCapacity">Horse capacity</label>
        <input required class="form-control" id="horseCapacity" type="number" step="1" minlength="1" maxlength="100" name="horseCapacity" placeholder="Enter an horse capacity" value="{{ old('horseCapacity') }}">
    </div>
    <div class="form-group">
        <label for="itemList">Items list</label>
        <textarea required class="form-control" id="itemList" name="itemList" placeholder="Enter a list of items">{{ old('itemList') }}</textarea>
        <small id="itemsListHelpBlock" class="form-text text-muted">Separate each item with a /</small>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
