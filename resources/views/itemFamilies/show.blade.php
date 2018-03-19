@extends('layouts.app')

@section('content')

<h1>Item family details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Item family id : {{ $itemFamily->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('itemfamilies.edit', $itemFamily->id) }}">Edit</a>
        <form method="POST" action="{{ route('itemfamilies.destroy', $itemFamily->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $itemFamily->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <p>Family name : {{ $itemFamily->familyName }}</p>
    <p>
        Description :
        {{ $itemFamily->description }}
    </p>
</div>
@endsection
