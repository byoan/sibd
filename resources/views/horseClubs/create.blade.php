@extends('layouts.app')

@section('content')

<h1>Create Horse club</h1>
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

<form action="/horseclubs" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="capacity">Capacity</label>
        <input required class="form-control" type="number" step="1" id="capacity" name="capacity" placeholder="Enter the capacity of the horse club" value="{{ old('capacity') }}">
    </div>
    <div class="form-group">
        <label for="infraList">Infrastructures list</label>
        <input required class="form-control" id="infraList" name="infraList" placeholder="Enter a list of infrastructures ids belonging to the horse club" value="{{ old('infraList') }}">
        <small id="infraList" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <div class="form-group">
        <label for="contestList">Contests list</label>
        <input required class="form-control" id="contestList" name="contestList" placeholder="Enter a list of contest ids belonging to the horse club" value="{{ old('contestList') }}">
        <small id="contestList" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <div class="form-group">
        <label for="userList">Members list</label>
        <input required class="form-control" id="userList" name="userList" placeholder="Enter a list of users ids belonging to the horse club" value="{{ old('userList') }}">
        <small id="userList" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <div class="form-group">
        <label for="idUser">Owner</label>
        <input required class="form-control" type="number" step="1" id="idUser" name="idUser" placeholder="Enter the user id of the club owner" value="{{ old('idUser') }}">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
