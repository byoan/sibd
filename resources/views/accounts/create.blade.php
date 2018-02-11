@extends('layouts.app')

@section('content')

<h1>Create Account</h1>

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
    <label for="balance">
    <input type="number" placeholder="Account balance, in LederCoin" name="balance">

    <button type="submit">Submit</button>
</form>
@endsection
