@extends('layouts.app')

@section('content')

<h1>Create Item-Horse relation</h1>
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

<form action="/itemslist" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="idHorse">Id Horse</label>
        <input required type="number" step="1" class="form-control" id="idHorse" name="idHorse" placeholder="Enter the target horse id" value={{ old('idHorse') }}>
    </div>
    <div class="form-group">
        <label for="idItem">Id Item</label>
        <input required type="number" step="1" class="form-control" id="idItem" name="idItem" placeholder="Enter the item to affect to the horse" value={{ old('idItem') }}>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
