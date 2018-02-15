@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Auto Tasks list</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('autotasks.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="autotasks" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($autotasks))
        <h4>No task available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Action</th>
                <th scope="col">Frequency</th>
                <th scope="col">Id Object</th>
                <th scope="col">Id User</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($autotasks as $id => $task)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$task->id}}"></div></td>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->action }}</td>
                        <td>{{ $task->frequency }}</td>
                        <td>{{ $task->idObject }}</td>
                        <td>{{ $task->idUser }}</td>
                        <td class="tdActions">
                            <a href="{{ route('autotasks.show', ['id' => $task->id]) }}" class="btn btn-info">View</a>
                            <a href="{{ route('autotasks.edit', ['id' => $task->id]) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $autotasks->links() }}
    @endif
@endsection
