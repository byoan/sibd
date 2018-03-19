@extends('layouts.app')

@section('content')

<h1>Riding stable #{{ $ridingStable->id }} edition</h1>
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

<form action="/ridingstables/{{ $ridingStable->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="capacity">Capacity</label>
        <input required class="form-control" type="number" id="capacity" name="capacity" placeholder="Enter the capacity" value={{ $ridingStable->capacity }}>
    </div>
    <div class="form-group">
        <label for="infraList">Infra List</label>
        <input required class="form-control" id="infraList" name="infraList" placeholder="Enter a infraList" value={{ $ridingStable->infraList }}>
        <small id="infraListHelpBlock" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <div class="form-group">
        <label for="autoTaskList">AutoTask List</label>
        <input required class="form-control" id="autoTaskList" name="autoTaskList" placeholder="Enter a autoTaskList" value={{ $ridingStable->autoTaskList }}>
        <small id="autoTaskListHelpBlock" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
