@extends('layouts.app')

@section('content')

<h1>Create Indicator</h1>
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

<form action="/indicators" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Indicator name</label>
        <input required class="form-control" id="name" name="name" placeholder="Enter an indicator name" value="{{ old('name') }}">
    </div>
    <div class="form-group">
        <label for="value">Indicator value</label>
        <input required class="form-control" id="value" type="number" step="1" minlength="1" maxlength="100" name="value" placeholder="Enter an indicator value" value="{{ old('value') }}">
        <small id="valueHelpBlock" class="form-text text-muted">in %</small>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
