@extends('layouts.app')

@section('content')

<h1>Horse details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>Name : {{ $horse->name }} - Owner : <a href="{{ route('users.show', $horse->user->id)}}" title="Owner">{{ $horse->user->pseudo }}</a></h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('horses.edit', $horse->id) }}">Edit</a>
        <form method="POST" action="{{ route('horses.destroy', $horse->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $horse->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h2>Horse characteristics/h2>
    @if (empty($horse->history))
        <h4>No infomartions available</h4>
    @else
        <table class="table">
            <thead>
                <tr>
                <th scope="col">race</th>
                <th scope="col">description</th>
                <th scope="col">price</th>
                <th scope="col">experience</th>
                <th scope="col">level</th>
                <th scope="col">generalLevel</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($horse->history as $id => $row)
                    <tr>
                        <td>{{ $row->race }}</td>
                        <td>{{ $row->newBadescriptionlance }}</td>
                        <td>{{ $row->price }}</td>
                        <td>{{ $row->experience }}</td>
                        <td>{{ $row->level }}</td>
                        <td>{{ $row->generalLevel }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
