@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Horse attribute list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('atts.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="atts" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($atts))
        <h4>No horse attribute available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Name</th>
                <th scope="col">Value</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($atts as $id => $att)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$att->id}}"></div></td>
                        <td>{{ $att->id }}</td>
                        <td>{{ $att->name }}</td>
                        <td>{{ $att->value }}</td>
                        <td class="tdActions">
                            <a href="{{ route('atts.show', $att->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('atts.edit', $att->id) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $atts->links() }}
    @endif
@endsection
