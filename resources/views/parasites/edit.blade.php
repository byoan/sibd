@extends('layouts.app')

@section('content')

<h1>Parasite #{{ $parasite->id }} edition</h1>
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

<form action="/parasites/{{ $parasite->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="typeParasite">Parasite type</label>
        <input required class="form-control" id="typeParasite" name="typeParasite" placeholder="Enter the parasite type" value={{ $parasite->typeParasite }}>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description">{{ $parasite->description }}</textarea>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
