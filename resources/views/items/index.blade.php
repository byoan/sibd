@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Items list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('items.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="items" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($items))
        <h4>No items available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Type</th>
                <th scope="col">Level</th>
                <th scope="col">Family</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $id => $item)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$item->id}}"></div></td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->type }}</td>
                        <td>{{ $item->level }}</td>
                        <td>{{ $item->family }}</td>
                        <td class="tdActions">
                            <a href="{{ route('items.show', $item->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $items->links() }}
    @endif
@endsection
