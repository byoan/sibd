@extends('layouts.app')

@section('content')

<h1>Injury #{{ $injury->id }} edition</h1>
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

<form action="/injuries/{{ $injury->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="typeInjury">Injury name</label>
        <input required class="form-control" id="typeInjury" name="typeInjury" placeholder="Enter an injury name" value="{{ $injury->typeInjury }}">
    </div>
    <div class="form-group">
        <label for="description">Injury description</label>
        <input required class="form-control" id="description" maxlength="191" name="description" placeholder="Enter an injury short description" value="{{ $injury->description }}">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
