@extends('layouts.app')

@section('content')

<h1>Riding stable details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>RidingStable id : {{ $ridingStable->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('ridingstables.edit', $ridingStable->id) }}">Edit</a>
        <form method="POST" action="{{ route('ridingstables.destroy', $ridingStable->id) }}">
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
        @foreach ($ridingStable->infraList as $id => $infrastructure)
            <li><a href="/infrastructures/{{ $infrastructure }}" title="Go to infrastructure details">{{ $infrastructure }}</a></li>
        @endforeach
    </ul>

    <h2>AutoTaskList : </h2>
    <ul>
        @foreach ($ridingStable->autoTaskList as $id => $task)
            <li><a href="/autotasks/{{ $task }}" title="Go to task details">{{ $task }}</a></li>
        @endforeach
    </ul>
</div>
@endsection
