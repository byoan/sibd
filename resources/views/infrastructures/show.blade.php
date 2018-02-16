@extends('layouts.app')

@section('content')

<h1>Infrastructure details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Infrastructure id : {{ $infrastructure->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('infrastructures.edit', $infrastructure->id) }}">Edit</a>
        <form method="POST" action="{{ route('infrastructures.destroy', $infrastructure->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $infrastructure->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <p>Type : {{ $infrastructure->type }}</p>
    <p>Level : {{ $infrastructure->level }}</p>
    <p>Description : {{ $infrastructure->description }}</p>
    <p>Family : {{ $infrastructure->family }}</p>
    <p>Price : {{ $infrastructure->price }}</p>
    <p>Resources consumption : {{ $infrastructure->ressourcesConsumption }}</p>
    <p>Items capacity : {{ $infrastructure->itemCapacity }}</p>
    <p>Horses capacity : {{ $infrastructure->horseCapacity }}</p>
    <h4>Items list</h4>
    @if (count($infrastructure->itemList > 0))
        @foreach ($infrastructure->itemList as $item)
            <p><a href="{{ route('items.show', $item) }}" title="Item details">{{ $item }}</a></p>
        @endforeach
    @else
        <p>No items in this infrastructure</p>
    @endif
</div>
@endsection
