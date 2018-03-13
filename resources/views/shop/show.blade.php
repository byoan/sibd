@extends('layouts.app')

@section('content')

<h1>Shop details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Shop id : {{ $shop->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('shops.edit', $shop->id) }}">Edit</a>
        <form method="POST" action="{{ route('shops.destroy', $shop->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $shop->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <h2>HorseList : </h2>
    <ul>
        {% for horse in horseList %}
        <li>{{horse}}</li>
        {% endfor %}
    </ul>

    <h2>ItemList : </h2>
    <ul>
        {% for item in itemList %}
        <li>{{item}}</li>
        {% endfor %}
    </ul>

    <h2>InfraList : </h2>
    <ul>
        {% for infrastructure in infraList %}
        <li>{{infrastructure}}</li>
        {% endfor %}
    </ul>

    <h2>RidingStableList : </h2>
    <ul>
        {% for ridingStabe in ridingStableList %}
        <li>{{ridingStable}}</li>
        {% endfor %}
    </ul>

    <h2>HorseClubList : </h2>
    <ul>
        {% for horseClub in horseClubList %}
        <li>{{horseClub}}</li>
        {% endfor %}
    </ul>
        
</div>
@endsection
