@extends('layouts.app')

@section('content')

<h1>Attribute details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Attribute id : {{ $att->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('atts.edit', $att->id) }}">Edit</a>
        <form method="POST" action="{{ route('atts.destroy', $att->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $att->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <p>Name : {{ $att->name }}</p>
    <p>Value : {{ $att->value }}</p>
</div>
@endsection
