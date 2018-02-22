@extends('layouts.app')

@section('content')

<h1>Create Horse Attribute</h1>
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

<form action="/atts" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Horse attribute name</label>
        <input required class="form-control" id="name" name="name" placeholder="Enter an horse attribute name" value="{{ old('name') }}">
    </div>
    <div class="form-group">
        <label for="value">Horse attribute value</label>
        <input required class="form-control" id="value" type="number" step="1" minlength="1" maxlength="100" name="value" placeholder="Enter an horse attribute value" value="{{ old('value') }}">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
