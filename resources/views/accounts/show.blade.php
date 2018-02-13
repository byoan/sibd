@extends('layouts.app')

@section('content')

<h1>Account details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Id : {{ $account->id }} - Owner : <a href="{{ route('users.show', $account->user->id)}}" title="Owner">{{ $account->user->username }}</a></h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('accounts.edit', $account->id) }}">Edit</a>
        <form method="POST" action="{{ route('accounts.destroy', $account->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $account->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
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
