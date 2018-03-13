@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>News relations listing</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('newslists.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="newslists" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($newsList))
        <h4>No news relations available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Id Newspaper</th>
                <th scope="col">Id News</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($newsList as $id => $news)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$news->id}}"></div></td>
                        <td>{{ $news->id }}</td>
                        <td>{{ $news->idNewspaper }}</td>
                        <td>{{ $news->idNews }}</td>
                        <td class="tdActions">
                            <a href="{{ route('newslists.show', ['id' => $news->id]) }}" class="btn btn-info">View</a>
                            <a href="{{ route('newslists.edit', ['id' => $news->id]) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $newsList->links() }}
    @endif
@endsection
