@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Diseases list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('diseases.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="diseases" title="Delete selected rows">Delete selected rows</button>
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
        <h4>No diseases available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Disease type</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($diseases as $id => $disease)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$disease->id}}"></div></td>
                        <td>{{ $disease->id }}</td>
                        <td>{{ $disease->typeDisease }}</td>
                        <td>{{ $disease->description }}</td>
                        <td class="tdActions">
                            <a href="{{ route('diseases.show', $disease->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('diseases.edit', $disease->id) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $diseases->links() }}
    @endif
@endsection
