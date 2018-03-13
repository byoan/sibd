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
        <label for="horseList">Shop horseList</label>
        <input required class="form-control" id="horseList" name="horseList" placeholder="Enter a horse list" value="{{ old('horseList') }}">
    </div>
    <div class="form-group">
        <label for="itemList">Shop itemList</label>
        <input required class="form-control" id="itemList" name="itemList" placeholder="Enter a item list" value="{{ old('itemList') }}">
    </div>
    <div class="form-group">
        <label for="infraList">Shop infraList</label>
        <input required class="form-control" id="infraList" name="infraList" placeholder="Enter a infra list" value="{{ old('itemList') }}">
    </div>
    <div class="form-group">
        <label for="ridingStableList">Shop ridingStableList</label>
        <input required class="form-control" id="ridingStableList" name="ridingStableList" placeholder="Enter a ridingStable list" value="{{ old('ridingStableList') }}">
    </div>
    <div class="form-group">
        <label for="horseClubList">Shop horseClubList</label>
        <input required class="form-control" id="horseClubList" name="horseClubList" placeholder="Enter a horseClub list" value="{{ old('horseClubList') }}">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
