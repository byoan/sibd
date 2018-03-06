@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Injuries list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('injuries.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="injuries" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($injuries))
        <h4>No injuries available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Type Injury</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($injuries as $id => $injury)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$injury->id}}"></div></td>
                        <td>{{ $injury->id }}</td>
                        <td>{{ $injury->typeInjury }}</td>
                        <td class="tdActions">
                            <a href="{{ route('injuries.show', $injury->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('injuries.edit', $injury->id) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $injuries->links() }}
    @endif
@endsection
