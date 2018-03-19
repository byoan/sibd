@extends('layouts.app')

@section('content')

<h1>Create Riding stable</h1>
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

<form action="/ridingstables" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="capacity">Riding stable capacity</label>
        <input required class="form-control" type="number" id="capacity" name="capacity" placeholder="Enter the capacity" value={{ old('capacity') }}>
    </div>
    <div class="form-group">
        <label for="infraList">Riding stable infrastructure list</label>
        <input required class="form-control" id="infraList" name="infraList" placeholder="Enter an infrastructure list" value="{{ old('infraList') }}">
        <small id="infraListHelpBlock" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <div class="form-group">
        <label for="autoTaskList">Riding stable automated tasks list</label>
        <input required class="form-control" id="autoTaskList" name="autoTaskList" placeholder="Enter an automated tasks list" value="{{ old('autoTaskList') }}">
        <small id="autoTaskListHelpBlock" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
