@extends('layouts.app')

@section('content')

<h1>horse #{{ $horse->id }} edition</h1>
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

<form action="/horses/{{ $horse->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="balance">Balance</label>
        <input class="form-control" type="number" name="balance" value="{{$horse->balance}}" step="0.001">
    </div>
    <div class="form-group transactionsHistoryList">
        <label for="history">Transaction history</label>
        @foreach (json_decode($horse->history) as $id => $row)
            <p>
                    {{ $row->transactionName }} => {{ $row->newBalance }}
            </p>
        @endforeach
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
