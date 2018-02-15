@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Infrastructures list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('infrastructures.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="infrastructures" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($infrastructures))
        <h4>No infrastructures available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Type</th>
                <th scope="col">Family</th>
                <th scope="col">Level</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($infrastructures as $id => $infrastructure)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$infrastructure->id}}"></div></td>
                        <td>{{ $infrastructure->id }}</td>
                        <td>{{ $infrastructure->type }}</td>
                        <td>{{ $infrastructure->family }}</td>
                        <td>{{ $infrastructure->level }}</td>
                        <td class="tdActions">
                            <a href="{{ route('infrastructures.show', $infrastructure->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('infrastructures.edit', $infrastructure->id) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $infrastructures->links() }}
    @endif
@endsection
