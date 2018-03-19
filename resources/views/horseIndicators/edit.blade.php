@extends('layouts.app')

@section('content')

<h1>Horse-Indicator relation #{{ $horseIndicator->id }} edition</h1>
<hr />

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/horseindicators/{{ $horseIndicator->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="idHorse">Id Horse</label>
        <input required type="number" step="1" class="form-control" id="idHorse" name="idHorse" placeholder="Enter the target horse id" value={{ $horseIndicator->idHorse }}>
    </div>
    <div class="form-group">
        <label for="idIndicator">Id Indicator</label>
        <input required type="number" step="1" class="form-control" id="idIndicator" name="idIndicator" placeholder="Enter the indicator id to affect to this horse" value={{ $horseIndicator->idIndicator }}>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
