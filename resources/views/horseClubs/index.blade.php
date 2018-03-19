@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Horse clubs list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('horseclubs.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="horseclubs" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($horseClubs))
        <h4>No horse clubs available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Capacity</th>
                <th scope="col">Users list</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($horseClubs as $id => $club)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$club->id}}"></div></td>
                        <td>{{ $club->id }}</td>
                        <td>{{ $club->capacity }}</td>
                        <td>{{ $club->userList }}</td>
                        <td class="tdActions">
                            <a href="{{ route('horseclubs.show', $club->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('horseclubs.edit', $club->id) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $horseClubs->links() }}
    @endif
@endsection
