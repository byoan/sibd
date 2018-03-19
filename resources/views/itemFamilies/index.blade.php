@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Items families listing</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('itemfamilies.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="itemfamilies" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($itemFamilies))
        <h4>No items families available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Family name</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itemFamilies as $id => $item)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$item->id}}"></div></td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->familyName }}</td>
                        <td class="tdActions">
                            <a href="{{ route('itemfamilies.show', ['id' => $item->id]) }}" class="btn btn-info">View</a>
                            <a href="{{ route('itemfamilies.edit', ['id' => $item->id]) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $itemFamilies->links() }}
    @endif
@endsection
