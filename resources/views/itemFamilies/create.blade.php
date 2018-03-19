@extends('layouts.app')

@section('content')

<h1>Create Item family</h1>
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

<form action="/itemfamilies" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="familyName">Family Name</label>
        <input required class="form-control" id="familyName" name="familyName" placeholder="Enter the family name" value={{ old('familyName') }}>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" placeholder="Enter the family description">{{ old('description') }}</textarea>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
