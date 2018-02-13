@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Horses list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('accounts.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="horses" title="Delete selected rows">Delete selected rows</button>
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
        <h4>No horses available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Race</th>
                <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($horses as $id => $horse)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$account->id}}"></div></td>
                        <td>{{ $horse->id }}</td>
                        <td>{{ $horse->balance}}</td>
                        <td class="tdActions">
                            <a href="{{ route('horses.show', ['id' => $horse->id]) }}" class="btn btn-info">View</a>
                            <a href="{{ route('horses.edit', ['id' => $horse->id]) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $horses->links() }}
    @endif
@endsection