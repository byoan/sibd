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
    <h2>RidingStable id : {{ $ridingStable->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('ridingStables.edit', $ridingStable->id) }}">Edit</a>
        <form method="POST" action="{{ route('ridingStables.destroy', $ridingStable->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $ridingStable->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <p>Capacity : {{ $ridingStable->capacity }}</p>

    <h2>InfraList : </h2>
    <ul>
        {% for infrastructure in infraList %}
        <li>{{infrastructure}}</li>
        {% endfor %}
    </ul>

    <h2>AutoTaskList : </h2>
    <ul>
        {% for autoTask in autoTaskList %}
        <li>{{autoTask}}</li>
        {% endfor %}
    </ul>        
</div>
@endsection
