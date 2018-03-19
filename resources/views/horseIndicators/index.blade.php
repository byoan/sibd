@extends('layouts.app')

@section('content')
    <div class="headerIndexContainer">
        <h1>Horse-Indicator relations listing</h1>
        <div class="headerIndexButtonsContainer">
            <a class="btn btn-success" href="{{ route('horseindicators.create') }}" title="Create">Create</a>
            <button name="deleteSelectedRows" class="btn btn-danger" style="display:none" data-id-table="horseindicators" title="Delete selected rows">Delete selected rows</button>
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

    @if (empty($horseIndicators))
        <h4>No horse indicators available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">Id</th>
                <th scope="col">Horse Id</th>
                <th scope="col">Indicator Id</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($horseIndicators as $id => $indicator)
                    <tr>
                        <td id="checkbox"><div class="form-check"><input class="form-check-input" type="checkbox" name="{{$indicator->id}}"></div></td>
                        <td>{{ $indicator->id }}</td>
                        <td>{{ $indicator->idHorse }}</td>
                        <td>{{ $indicator->idIndicator }}</td>
                        <td class="tdActions">
                            <a href="{{ route('horseindicators.show', ['id' => $indicator->id]) }}" class="btn btn-info">View</a>
                            <a href="{{ route('horseindicators.edit', ['id' => $indicator->id]) }}" class="btn btn-dark">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $horseIndicators->links() }}
    @endif
@endsection
