@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h1>Account #{{ $account->id }} edition</h1>
<hr />

<form action="/accounts/{{ $account->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <input type="number" name="balance" value="{{$account->balance}}">
    <button type="submit">Submit</button>
</form>
@endsection
