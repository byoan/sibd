@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Parasites list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('parasites.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="parasites" title="Delete selected rows">Delete selected rows</button>
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
                <th scope="col">Parasite type</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parasites as $id => $parasite)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$parasite->id}}"></div></td>
                        <td>{{ $parasite->id }}</td>
                        <td>{{ $parasite->typeParasite }}</td>
                        <td class="tdActions">
                            <a href="{{ route('parasites.show', ['id' => $parasite->id]) }}" class="btn btn-info">View</a>
                            <a href="{{ route('parasites.edit', ['id' => $parasite->id]) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $parasites->links() }}
    @endif
@endsection
