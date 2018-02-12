@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h1>Account details</h1>
<hr />
<h2>Id : {{ $account->id }}</h2>
<h2>Balance : {{ $account->balance }} LederCoin</h2>
<br />
<div>
    <h2>Transaction history</h2>
    @if (empty($account->history))
        <h4>No transactions available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Transaction name</th>
                <th scope="col">New LederCoin balance</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($account->history as $id => $row)
                    <tr>
                        <td>{{ $row->transactionName }}</td>
                        <td>{{ $row->newBalance }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
