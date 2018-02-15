@extends('layouts.app')

@section('content')

<h1>Disease details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Disease type : {{ $disease->typeDisease }} (#{{ $disease->id }})</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('diseases.edit', $disease->id) }}">Edit</a>
        <form method="POST" action="{{ route('diseases.destroy', $disease->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $disease->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <p>Description : {{ $disease->description }}</p>
</div>
@endsection
