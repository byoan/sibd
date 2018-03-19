@extends('layouts.app')

@section('content')

<h1>Horse club details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Horse club id : {{ $horseClub->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('horseclubs.edit', $horseClub->id) }}">Edit</a>
        <form method="POST" action="{{ route('horseclubs.destroy', $horseClub->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $horseClub->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <p>Capacity : {{ $horseClub->capacity }}</p>
    <p>Owner : <a href="/users/{{ $horseClub->idUser }}">{{ $horseClub->idUser }}</a>
    <p>
        Infrastructures list :
        @foreach ($horseClub->infraList as $infra)
            <li><a href="/horseclubs/{{ $infra }}" title="Go to the infrastructure details">{{ $infra }}</a></li>
        @endforeach
    </p>
    <p>
        Contests list :
        @foreach ($horseClub->contestList as $contest)
            <li><a href="/contests/{{ $contest }}" title="Go to the contest details">{{ $contest }}</a></li>
        @endforeach
    </p>
    <p>
        Members list :
        @foreach ($horseClub->userList as $user)
            <li><a href="/users/{{ $user }}" title="Go to the member details">{{ $user }}</a></li>
        @endforeach
    </p>
</div>
@endsection
