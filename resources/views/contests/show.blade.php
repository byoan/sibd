@extends('layouts.app')

@section('content')

<h1>Contest details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Contest id : {{ $contest->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('contests.edit', $contest->id) }}">Edit</a>
        <form method="POST" action="{{ route('contests.destroy', $contest->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $contest->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <p>itemList : {{ $contest->itemList }}</p>
    <p>Begin date : {{ $contest->beginDate }}</p>
    <p>End date : {{ $contest->endDate }}</p>
</div>
@endsection