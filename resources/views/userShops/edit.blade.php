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

<form action="/usershops/{{ $shop->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="idUser">Owner id</label>
        <input required class="form-control" type="number" step="1" id="idUser" name="idUser" placeholder="Enter the owner user id" value="{{ $shop->idUser }}">
    </div>
    <div class="form-group">
        <label for="horseList">Horse list</label>
        <input required class="form-control" id="horseList" name="horseList" placeholder="Enter a horse list" value="{{ $shop->horseList }}">
        <small id="horseList" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <div class="form-group">
        <label for="itemList">Items list</label>
        <input required class="form-control" id="itemList" name="itemList" placeholder="Enter a item list" value="{{ $shop->itemList }}">
        <small id="itemList" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <div class="form-group">
        <label for="infraList">Infrastructures list</label>
        <input required class="form-control" id="infraList" name="infraList" placeholder="Enter a infra list" value="{{ $shop->itemList }}">
        <small id="infraList" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <div class="form-group">
        <label for="ridingStableList">Riding stables list</label>
        <input required class="form-control" id="ridingStableList" name="ridingStableList" placeholder="Enter a ridingStable list" value="{{ $shop->ridingStableList }}">
        <small id="ridingStableList" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <div class="form-group">
        <label for="horseClubList">Horse clubs list</label>
        <input required class="form-control" id="horseClubList" name="horseClubList" placeholder="Enter a horseClub list" value="{{ $shop->horseClubList }}">
        <small id="horseClubList" class="form-text text-muted">Separated by a "/"</small>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
