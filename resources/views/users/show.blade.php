@extends('layouts.app')

@section('content')

<h1>User details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Username : {{ $user->username }} (#{{ $user->id }})</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('users.edit', $user->id) }}">Edit</a>
        <form method="POST" action="{{ route('users.destroy', $user->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $user->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<h2>{{ $user->firstName }} {{ $user->lastName }}</h2>
<br />
<div>
    <h3>Informations</h3>
    <p>Description : {{ $user->description }}</p>
    <p>Sex : {{ $user->sex }}</p>
    <p>Birth date : {{ $user->birthDate }}</p>
    <p>Address : {{ $user->address }}</p>
    <p>Phone : {{ $user->phone }}</p>
    <p>Website : <a href="{{ $user->website }}" title="Website">{{ $user->website }}</a></p>
    <p>Last connection : {{ date('d-m-Y H:m:s', strtotime($user->connectionDate)) }}</p>
    <p>Last recorded IP address : {{ $user->ipAddress }}</p>
    <p>Inscription date : {{ date('d-m-Y H:m:s', strtotime($user->inscriptionDate)) }}</p>

    <hr />
    <h3>Planning</h3>
    @if (empty($user->planning))
        <h4>This user has no automated task planned</h4>
    @else
        <ul>
            @foreach ($user->planning as $id => $task)
                <li>"{{ $task->action }}", {{ $task->frequency }} times a day</li>
            @endforeach
        </ul>
    @endif

    <hr />
    <h3>Account</h3>
    @if (empty($user->account))
        <h4>This user has no account</h4>
    @else
        <h4>Balance : {{ $user->account->balance }} LederCoin</h4>
        <a href="{{ route('accounts.show', $user->account->id) }}" title="Account">See his/her account #{{ $user->account->id}}</a>
    @endif
</div>
@endsection
