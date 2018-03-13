@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Shops list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('shops.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="shops" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($shops))
        <h4>No shops available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">HorseList</th>
                <th scope="col">ItemList</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shops as $id => $shop)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$shop->id}}"></div></td>
                        <td>{{ $shop->id }}</td>
                        <td>{{ $shop->horseList }}</td>
                        <td>{{ $shop->itemList }}</td>
                        <td>{{ $shop->infraList }}</td>
                        <td>{{ $shop->ridingStableList }}</td>
                        <td>{{ $shop->horseClubList }}</td>
                        <td class="tdActions">
                            <a href="{{ route('shops.show', ['id' => $shop->id]) }}" class="btn btn-info">View</a>
                            <a href="{{ route('shops.edit', ['id' => $shop->id]) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $shops->links() }}
    @endif
@endsection
