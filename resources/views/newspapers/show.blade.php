@extends('layouts.app')

@section('content')

<h1>Newspaper details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Newspaper #{{ $newspaper->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('newspapers.edit', $newspaper->id) }}">Edit</a>
        <form method="POST" action="{{ route('newspapers.destroy', $newspaper->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $newspaper->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <p>Newspaper date : {{ $newspaper->dayDate }}</p>
    <h4>Agenda</h4>
    @foreach ($newspaper->agenda as $row)
        <p>{{ $row}} </p>
    @endforeach
    <h4>Previous day best moments</h4>
    @foreach ($newspaper->previousDayBestMoments as $row)
        <p>{{ $row }}</p>
    @endforeach
</div>
@endsection
