@extends('layouts.app')

@section('content')

<h1>Item details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Item id : {{ $item->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('items.edit', $item->id) }}">Edit</a>
        <form method="POST" action="{{ route('items.destroy', $item->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $item->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <p>{{ $item->type }}</p>
    <p>{{ $item->level }}</p>
    <p>{{ $item->description }}</p>
    <p>{{ $item->price }}</p>
</div>
@endsection
