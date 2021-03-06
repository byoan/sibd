@extends('layouts.app')

@section('content')

<h1>Create Horse <-> Disease relation</h1>
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

<form action="/diseasesLists" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="idHorse">ID Horse</label>
        <input required class="form-control" type="number" step="1" id="idHorse" name="idHorse" placeholder="Enter a horse id" value={{ old('idHorse') }}>
    </div>
    <div class="form-group">
        <label for="idDisease">ID Disease</label>
        <input required class="form-control" type="number" step="1" id="idDisease" name="idDisease" placeholder="Enter a disease id" value={{ old('idDisease') }}>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
