@extends('layouts.app')

@section('content')

<h1>Attribute #{{ $att->id }} edition</h1>
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

<form action="/atts/{{ $att->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Name</label>
        <input required class="form-control" id="name" name="name" placeholder="Enter an attribute name" value="{{ $att->name }}">
    </div>
    <div class="form-group">
        <label for="price">Value</label>
        <input required class="form-control" id="value" type="number" step="1" name="value" placeholder="Enter an attribute value" value="{{ $att->value }}">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
