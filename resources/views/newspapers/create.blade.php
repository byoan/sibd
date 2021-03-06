@extends('layouts.app')

@section('content')

<h1>Create newspaper</h1>
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

<form action="/newspapers" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="dayDate">Day date</label>
        <input required class="form-control" type="date" id="dayDate" name="dayDate" placeholder="Enter the day's date" value={{ old('dayDate') }}>
    </div>
    <div class="form-group">
        <label for="agenda">Agenda</label>
        <textarea class="form-control" id="agenda" name="agenda">{{ old('agenda') }}</textarea>
        <small id="agendaHelpBlock" class="form-text text-muted">One event per line, otherwise it won't be presented properly</small>
    </div>
    <div class="form-group">
        <label for="previousDayBestMoments">Previous days best moments</label>
        <textarea class="form-control" id="previousDayBestMoments" name="previousDayBestMoments">{{ old('previousDayBestMoments') }}</textarea>
        <small id="previousDayBestMomentsHelpBlock" class="form-text text-muted">One best moment per line, otherwise it won't be presented properly</small>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
