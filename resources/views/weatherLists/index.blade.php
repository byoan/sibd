@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Weather lists list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('weatherlists.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="weatherlists" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($weatherLists))
        <h4>No weather lists available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Id Newspaper</th>
                <th scope="col">Id Weather</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weatherLists as $id => $weather)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$weather->id}}"></div></td>
                        <td>{{ $weather->id }}</td>
                        <td>{{ $weather->idNewspaper }}</td>
                        <td>{{ $weather->idWeather }}</td>
                        <td class="tdActions">
                            <a href="{{ route('weatherlists.show', ['id' => $weather->id]) }}" class="btn btn-info">View</a>
                            <a href="{{ route('weatherlists.edit', ['id' => $weather->id]) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $weatherLists->links() }}
    @endif
@endsection
