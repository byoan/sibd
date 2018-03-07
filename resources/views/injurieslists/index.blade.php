@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Injuries associations list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('injurieslists.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="injurieslists" title="Delete selected rows">Delete selected rows</button>
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
        <h4>No injuries associations available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Horse Id</th>
                <th scope="col">Injury Id</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($injuries as $id => $injury)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$injury->id}}"></div></td>
                        <td>{{ $injury->id }}</td>
                        <td>{{ $injury->idHorse }}</td>
                        <td>{{ $injury->idInjury }}</td>
                        <td class="tdActions">
                            <a href="{{ route('injurieslists.show', $injury->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('injurieslists.edit', $injury->id) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $injuries->links() }}
    @endif
@endsection
