@extends('layouts.app')

@section('content')

<h1>Parasite-Horse relation details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Parasite-horse relation #{{ $parasite->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('parasiteslists.edit', $parasite->id) }}">Edit</a>
        <form method="POST" action="{{ route('parasiteslists.destroy', $parasite->id) }}">
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
    <p>Horse ID : <a href="{{ route('horses.show', $parasite->idHorse) }}">{{ $parasite->idHorse }}</a></p>
    <p>Parasite ID : <a href="{{ route('parasites.show', $parasite->idParasite) }}">{{ $parasite->idParasite }}</a></p>
</div>
@endsection
