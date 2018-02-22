@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Contest list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('contests.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="contests" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($contests))
        <h4>No contest available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">itemList</th>
                <th scope="col">beginDate</th>
                <th scope="col">endDate</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contests as $id => $contest)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$contest->id}}"></div></td>
                        <td>{{ $contest->id }}</td>
                        <td>{{ $contest->itemList }}</td>
                        <td>{{ $contest->beginDate }}</td>
                        <td>{{ $contest->endDate }}</td>
                        <td class="tdActions">
                            <a href="{{ route('contests.show', $contest->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('contests.edit', $contest->id) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $contests->links() }}
    @endif
@endsection
