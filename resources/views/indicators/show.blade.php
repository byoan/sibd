@extends('layouts.app')

@section('content')

<h1>Indicator details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Indicator id : {{ $indicator->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('indicators.edit', $indicator->id) }}">Edit</a>
        <form method="POST" action="{{ route('indicators.destroy', $indicator->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $indicator->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Indicator name : {{ $indicator->name }}</h3>
    <h3>Indicator value : {{ $indicator->value }}</h3>
</div>
@endsection
