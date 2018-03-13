@extends('layouts.app')

@section('content')

<h1>Item-Horse relation details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Item-Horse relation id : {{ $itemList->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('itemslist.edit', $itemList->id) }}">Edit</a>
        <form method="POST" action="{{ route('itemslist.destroy', $itemList->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $itemList->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <p>Id Horse :  <a href="{{ route('horses.show', $itemList->idHorse)}}" title="See the horse details">{{ $itemList->idHorse }}</a></p></p>
    <p>Id Item : <a href="{{ route('items.show', $itemList->idItem)}}" title="See the item details">{{ $itemList->idItem }}</a></p>
</div>
@endsection
