@extends('layouts.app')

@section('content')

<h1>Horse-Indicator relation details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Horse-Indicator relation id : {{ $horseIndicator->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('horseindicators.edit', $horseIndicator->id) }}">Edit</a>
        <form method="POST" action="{{ route('horseindicators.destroy', $horseIndicator->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $horseIndicator->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h3>Informations</h3>
    <p>Id Horse :  <a href="{{ route('horses.show', $horseIndicator->idHorse)}}" title="See the horse details">{{ $horseIndicator->idHorse }}</a></p></p>
    <p>Id Indicator : <a href="{{ route('indicators.show', $horseIndicator->idIndicator)}}" title="See the indicator details">{{ $horseIndicator->idIndicator }}</a></p>
</div>
@endsection
