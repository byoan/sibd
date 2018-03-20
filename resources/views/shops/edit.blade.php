@extends('layouts.app')

@section('content')

<h1>Shop #{{ $shop->id }} edition</h1>
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

<form action="/shops/{{ $shop->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="horseList">Horse List</label>
        <input required class="form-control" id="horseList" name="horseList" placeholder="Enter a horseList" value={{ $shop->horseList }}>
        <small id="horseList" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <div class="form-group">
        <label for="itemList">Item List</label>
        <input required class="form-control" id="itemList" name="itemList" placeholder="Enter a itemList" value={{ $shop->itemList }}>
        <small id="itemList" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <div class="form-group">
        <label for="infraList">Infra List</label>
        <input required class="form-control" id="infraList" name="infraList" placeholder="Enter a infraList" value={{ $shop->infraList }}>
        <small id="infraList" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <div class="form-group">
        <label for="ridingStableList">RidingStable List</label>
        <input required class="form-control" id="ridingStableList" name="ridingStableList" placeholder="Enter a ridingStableList" value={{ $shop->ridingStableList }}>
        <small id="ridingStableList" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <div class="form-group">
        <label for="horseClubList">HorseClub List</label>
        <input required class="form-control" id="horseClubList" name="horseClubList" placeholder="Enter a horseClubList" value={{ $shop->horseClubList }}>
        <small id="horseClubList" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
