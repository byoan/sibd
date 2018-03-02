@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Horses diseases list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('diseasesLists.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="diseasesLists" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($diseases))
        <h4>No diseases lists available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Horse ID</th>
                <th scope="col">Disease ID</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($diseases as $id => $row)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{ $row->id }}"></div></td>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->idHorse }}</td>
                        <td>{{ $row->idDisease }}</td>
                        <td class="tdActions">
                            <a href="{{ route('diseasesLists.show', $row->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('diseasesLists.edit', $row->id) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $diseases->links() }}
    @endif
@endsection
