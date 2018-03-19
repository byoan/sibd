@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Riding stables list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('ridingstables.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="ridingstables" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($ridingStables))
        <h4>No ridingStables available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Capacity</th>
                <th scope="col">InfraList</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ridingStables as $id => $ridingStable)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$ridingStable->id}}"></div></td>
                        <td>{{ $ridingStable->id }}</td>
                        <td>{{ $ridingStable->capacity }}</td>
                        <td>{{ $ridingStable->infraList }}</td>
                        <td class="tdActions">
                            <a href="{{ route('ridingstables.show', ['id' => $ridingStable->id]) }}" class="btn btn-info">View</a>
                            <a href="{{ route('ridingstables.edit', ['id' => $ridingStable->id]) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $ridingStables->links() }}
    @endif
@endsection
