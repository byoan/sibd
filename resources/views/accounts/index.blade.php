@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Accounts list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('accounts.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="accounts" title="Delete selected rows">Delete selected rows</button>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('errors'))
        <div class="alert alert-danger">
            {{ session('errors') }}
        </div>
    @endif

    @if (empty($accounts))
        <h4>No accounts available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Balance</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $id => $account)
                    <tr>
                        <td><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$account->id}}"></div></td>
                        <td>{{ $account->id }}</td>
                        <td>{{ $account->balance}}</td>
                        <td class="tdActions">
                            <a href="{{ route('accounts.show', ['id' => $account->id]) }}" class="btn btn-info">View</a>
                            <a href="{{ route('accounts.edit', ['id' => $account->id]) }}" class="btn btn-dark">Edit</a>
                            <form method="POST" action="{{ route('accounts.destroy', ['id' => $account->id]) }}">
                                {{ csrf_field() }}
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $account->id }}">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $accounts->links() }}
    @endif
@endsection
