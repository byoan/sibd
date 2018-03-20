@extends('layouts.app')

@section('content')

<h1>User shop details</h1>
<hr />

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="detailsEditButtonRow">
    <h2>User shop id : {{ $shop->id }}</h2>
    <div class="detailsButtonsContainer">
        <a class="btn btn-dark" href="{{ route('usershops.edit', $shop->id) }}">Edit</a>
        <form method="POST" action="{{ route('usershops.destroy', $shop->id) }}">
            {{ csrf_field() }}
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $shop->id }}">
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
<br />
<div>
    <h2>Owner : <a href="/users/{{ $shop->idUser }}" title="Go to user details">{{$shop->idUser}}</a></h2>
    <h2>Horses list : </h2>
    <ul>
        @foreach ($shop->horseList as $id => $horse)
            <li><a href="/horses/{{ $horse }}" title="Go to horse details">{{ $horse }}</a></li>
        @endforeach
    </ul>

    <h2>Items list : </h2>
    <ul>
        @foreach ($shop->itemList as $id => $item)
            <li><a href="/items/{{ $item }}" title="Go to item details">{{ $item }}</a></li>
        @endforeach
    </ul>

    <h2>Infrastructures list : </h2>
    <ul>
        @foreach ($shop->infraList as $id => $infra)
            <li><a href="/infrastructures/{{ $infra }}" title="Go to infrastructure details">{{ $infra }}</a></li>
        @endforeach
    </ul>

    <h2>Riding stable list : </h2>
    <ul>
        @foreach ($shop->ridingStableList as $id => $ridingStable)
            <li><a href="/ridingstables/{{ $ridingStable }}" title="Go to the riding stable details">{{ $ridingStable }}</a></li>
        @endforeach
    </ul>

    <h2>HorseClubList : </h2>
    <ul>
        @foreach ($shop->horseClubList as $id => $horseClub)
            <li><a href="/horseclubs/{{ $horseClub }}" title="Go to the horse club details">{{ $horseClub }}</a></li>
        @endforeach
    </ul>

</div>
@endsection
