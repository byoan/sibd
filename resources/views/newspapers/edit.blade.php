@extends('layouts.app')

@section('content')

<h1>Newspaper #{{ $newspaper->id }} edition</h1>
<hr />

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/newspapers/{{ $newspaper->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="dayDate">Day date</label>
        <input required class="form-control" type="date" id="dayDate" name="dayDate" placeholder="Enter the day's date" value={{ $newspaper->dayDate }}>
    </div>
    <div class="form-group">
        <label for="agenda">Agenda</label>
        <textarea class="form-control" id="agenda" name="agenda">{{ $newspaper->agenda }}</textarea>
        <small id="agendaHelpBlock" class="form-text text-muted">One event per line, otherwise it won't be presented properly</small>
    </div>
    <div class="form-group">
        <label for="previousDayBestMoments">Previous days best moments</label>
        <textarea class="form-control" id="previousDayBestMoments" name="previousDayBestMoments">{{ $newspaper->previousDayBestMoments }}</textarea>
        <small id="previousDayBestMomentsHelpBlock" class="form-text text-muted">One best moment per line, otherwise it won't be presented properly</small>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
