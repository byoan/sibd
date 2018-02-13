@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Users list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('users.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="users" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($users))
        <h4>No users available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Pseudo</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $id => $user)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$user->id}}"></div></td>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->username}}</td>
                        <td class="tdActions">
                            <a href="{{ route('users.show', ['id' => $user->id]) }}" class="btn btn-info">View</a>
                            <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    @endif
@endsection
