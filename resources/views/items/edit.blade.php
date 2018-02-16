@extends('layouts.app')

@section('content')

<h1>Item #{{ $item->id }} edition</h1>
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

<form action="/items/{{ $item->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="type">Item type</label>
        <input required class="form-control" id="type" name="type" placeholder="Enter an item type" value="{{ $item->type }}">
    </div>
    <div class="form-group">
        <label for="level">Item level</label>
        <input required class="form-control" type="number" step="1" id="level" name="level" placeholder="Enter an item level" value="{{ $item->level }}">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea required class="form-control" id="description" name="description" placeholder="Enter an item description">{{ $item->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="family">Family</label>
        <input required class="form-control" id="family" name="family" placeholder="Enter an item family" value="{{ $item->family }}">
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input required class="form-control" type="number" step="0.001" id="price" name="price" placeholder="Enter an item price" value="{{ $item->price }}">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
