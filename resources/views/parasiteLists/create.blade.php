@extends('layouts.app')

@section('content')

<h1>Create parasite-horse relation</h1>
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

<form action="/parasiteslists" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="idParasite">Parasite ID</label>
        <input required class="form-control" type="number" step="1" id="idParasite" name="idParasite" placeholder="Enter the parasite id" value={{ old('idParasite') }}>
    </div>
    <div class="form-group">
        <label for="idHorse">Horse ID</label>
        <input required class="form-control" type="number" step="1" id="idHorse" name="idHorse" placeholder="Enter the horse id" value={{ old('idHorse') }}>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
