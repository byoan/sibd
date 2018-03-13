@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Items-Horses relations listing</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('itemslist.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="itemslist" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($itemLists))
        <h4>No items relations available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Id Horse</th>
                <th scope="col">Id Item</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itemLists as $id => $item)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$item->id}}"></div></td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->idHorse }}</td>
                        <td>{{ $item->idItem }}</td>
                        <td class="tdActions">
                            <a href="{{ route('itemslist.show', ['id' => $item->id]) }}" class="btn btn-info">View</a>
                            <a href="{{ route('itemslist.edit', ['id' => $item->id]) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $itemLists->links() }}
    @endif
@endsection
