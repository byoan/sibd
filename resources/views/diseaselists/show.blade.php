@extends('layouts.app')

@section('content')

<h1>Horse diseases list details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Disease list id : #{{ $disease->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('diseasesLists.edit', $disease->id) }}">Edit</a>
        <form method="POST" action="{{ route('diseasesLists.destroy', $disease->id) }}">
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
    <p>Related horse : <a href="{{ route('horses.show', $disease->idHorse) }}" title="See horse details">{{ $disease->idHorse }}</a></p>
    <p>Related disease : <a href="{{ route('diseases.show', $disease->idDisease) }}" title="See disease details">{{ $disease->idDisease }}</a></p>
</div>
@endsection
