@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Weathers list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('weathers.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="weathers" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($weathers))
        <h4>No weathers available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Type Weather</th>
                <th scope="col">Title</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weathers as $id => $weather)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$weather->id}}"></div></td>
                        <td>{{ $weather->id }}</td>
                        <td>{{ $weather->typeWeather }}</td>
                        <td>{{ $weather->title }}</td>
                        <td class="tdActions">
                            <a href="{{ route('weathers.show', $weather->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('weathers.edit', $weather->id) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $weathers->links() }}
    @endif
@endsection
