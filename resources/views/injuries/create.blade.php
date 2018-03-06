@extends('layouts.app')

@section('content')

<h1>Create Injury</h1>
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

<form action="/injuries" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="typeInjury">Injury name</label>
        <input required class="form-control" id="typeInjury" name="typeInjury" placeholder="Enter an injury name" value="{{ old('typeInjury') }}">
    </div>
    <div class="form-group">
        <label for="description">Injury description</label>
        <input required class="form-control" id="description" name="description" maxlength="191" placeholder="Enter an injury short description" value="{{ old('description') }}">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
