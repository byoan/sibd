@extends('layouts.app')

@section('content')

<h1>Contest #{{ $contest->id }} edition</h1>
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

<form action="/contests/{{ $contest->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="itemList">Contest itemList</label>
        <input required class="form-control" id="itemList" name="itemList" placeholder="Enter an itemList" value="{{ $contest->itemList }}">
    </div>
    <div class="form-group">
        <label for="beginDate">Contest begin date</label>
        <input required class="form-control" id="beginDate" type="date" name="beginDate" placeholder="Enter an begin date value" value="{{ $contest->beginDate }}">
    </div>
    <div class="form-group">
        <label for="endDate">Contest end date</label>
        <input required class="form-control" id="endDate" type="date" name="endDate" placeholder="Enter an end date value" value="{{ $contest->endDate }}">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
