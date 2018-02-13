@extends('layouts.app')

@section('content')

<h1>Create Account</h1>
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

<form action="/accounts" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="balance">Balance</label>
        <input class="form-control" type="number" placeholder="Account balance, in LederCoin" name="balance">
    </div>

    <button class="btn btn-success" type="submit">Submit</button>
</form>
@endsection
