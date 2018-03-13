@extends('layouts.app')

@section('content')

<h1>Create ridingStable</h1>
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

<form action="/ridingStables" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="capacity">RidingStable capacity</label>
        <input required class="form-control" type="number" id="capacity" name="capacity" placeholder="Enter the capacity" value={{ old('capacity') }}>
    </div>
    <div class="form-group">
        <label for="infraList">RidingStable infraList</label>
        <input required class="form-control" id="infraList" name="infraList" placeholder="Enter an infrastructure list" value="{{ old('infraList') }}">
    </div>
    <div class="form-group">
        <label for="autoTaskList">RidingStabme autoTaskList</label>
        <input required class="form-control" id="autoTaskList" name="autoTaskList" placeholder="Enter an autoTask list" value="{{ old('autoTaskList') }}">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
