@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Ad lists list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('adslist.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="adslist" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($ads))
        <h4>No ads list available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">idNewspaper</th>
                <th scope="col">idAd</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ads as $id => $ad)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$ad->id}}"></div></td>
                        <td>{{ $ad->id }}</td>
                        <td>{{ $ad->idNewspaper }}</td>
                        <td>{{ $ad->idAd }}</td>
                        <td class="tdActions">
                            <a href="{{ route('adslist.show', ['id' => $ad->id]) }}" class="btn btn-info">View</a>
                            <a href="{{ route('adslist.edit', ['id' => $ad->id]) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $ads->links() }}
    @endif
@endsection
