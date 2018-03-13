@extends('layouts.app')

@section('content')

<h1>Parasite details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Parasite #{{ $parasite->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('parasites.edit', $parasite->id) }}">Edit</a>
        <form method="POST" action="{{ route('parasites.destroy', $parasite->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $parasite->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <p>Parasite type : {{ $parasite->typeParasite }}</p>
    <p>Parasite description : {{ $parasite->description }}</p>
</div>
@endsection
