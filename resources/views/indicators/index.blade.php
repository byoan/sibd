@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Indicators list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('indicators.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="indicators" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($indicators))
        <h4>No indicators available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Value</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($indicators as $id => $indicator)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$indicator->id}}"></div></td>
                        <td>{{ $indicator->id }}</td>
                        <td>{{ $indicator->name }}</td>
                        <td>{{ $indicator->value }}</td>
                        <td class="tdActions">
                            <a href="{{ route('indicators.show', $indicator->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('indicators.edit', $indicator->id) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $indicators->links() }}
    @endif
@endsection
