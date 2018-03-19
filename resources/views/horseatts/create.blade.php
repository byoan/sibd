@extends('layouts.app')

@section('content')

<h1>Create Horse-Attribute relation</h1>
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

<form action="/horseatts" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="idHorse">Horse Id</label>
        <input required class="form-control" type="number" step="1" id="idHorse" name="idHorse" placeholder="Enter an horse id" value="{{ old('idHorse') }}">
    </div>
    <div class="form-group">
        <label for="idAtt">Attribute Id</label>
        <input required class="form-control" id="idAtt" type="number" step="1" minlength="1" maxlength="100" name="idAtt" placeholder="Enter an attribute id" value="{{ old('idAtt') }}">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
