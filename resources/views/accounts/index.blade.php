@extends('layouts.app')

@section('content')
    Accounts list

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @foreach ($accounts as $account)
        <h1>{{ $account->id }}</h1>
        <h2>{{ $account->balance}}</h2>
    @endforeach
@endsection
