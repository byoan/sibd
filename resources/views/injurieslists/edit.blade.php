@extends('layouts.app')

@section('content')

<h1>Injury association #{{ $injury->id }} edition</h1>
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

<form action="/injurieslists/{{ $injury->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="idHorse">Horse id</label>
        <input required class="form-control" id="idHorse" name="idHorse" placeholder="Enter the id of the targeted horse" value="{{ $injury->idHorse }}">
    </div>
    <div class="form-group">
        <label for="idInjury">Injury id</label>
        <input required class="form-control" id="idInjury" name="idInjury" placeholder="Enter the id of the targeted injury" value="{{ $injury->idInjury }}">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
