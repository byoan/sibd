@extends('layouts.app')

@section('content')

<h1>Create Shop</h1>
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

<form action="/shops" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="horseList">Shop horse list</label>
        <input required class="form-control" id="horseList" name="horseList" placeholder="Enter a horse list" value="{{ old('horseList') }}">
        <small id="horseList" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <div class="form-group">
        <label for="itemList">Shop items list</label>
        <input required class="form-control" id="itemList" name="itemList" placeholder="Enter a item list" value="{{ old('itemList') }}">
        <small id="itemList" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <div class="form-group">
        <label for="infraList">Shop infraList</label>
        <input required class="form-control" id="infraList" name="infraList" placeholder="Enter a infra list" value="{{ old('itemList') }}">
        <small id="infraList" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <div class="form-group">
        <label for="ridingStableList">Shop ridingStableList</label>
        <input required class="form-control" id="ridingStableList" name="ridingStableList" placeholder="Enter a ridingStable list" value="{{ old('ridingStableList') }}">
        <small id="ridingStableList" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <div class="form-group">
        <label for="horseClubList">Shop horseClubList</label>
        <input required class="form-control" id="horseClubList" name="horseClubList" placeholder="Enter a horseClub list" value="{{ old('horseClubList') }}">
        <small id="horseClubList" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
