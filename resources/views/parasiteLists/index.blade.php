@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Parasites-Horse relations list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('parasiteslists.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="parasiteslists" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($parasites))
        <h4>No parasites available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Parasite ID</th>
                <th scope="col">Horse ID</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parasites as $id => $parasite)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$parasite->id}}"></div></td>
                        <td>{{ $parasite->id }}</td>
                        <td>{{ $parasite->idParasite }}</td>
                        <td>{{ $parasite->idHorse }}</td>
                        <td class="tdActions">
                            <a href="{{ route('parasiteslists.show', ['id' => $parasite->id]) }}" class="btn btn-info">View</a>
                            <a href="{{ route('parasiteslists.edit', ['id' => $parasite->id]) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $parasites->links() }}
    @endif
@endsection
