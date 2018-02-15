@extends('layouts.app')

@section('content')

<h1>Create Auto Task</h1>
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

<form action="/autotasks" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="action">Action</label>
        <input required class="form-control" id="action" name="action" placeholder="Enter an action for the task, in a single word" maxlength="50" value={{ old('action') }}>
    </div>
    <div class="form-group">
        <label for="frequency">Frequency</label>
        <input required class="form-control" type="number" step="1" min="1" max="10" id="frequency" name="frequency" placeholder="Enter a frequency for the task" value={{ old('frequency') }}>
    </div>
    <div class="form-group">
        <label for="idObject">Id of the target object</label>
        <input required class="form-control" id="idObject" name="idObject" placeholder="Enter the target id object" value={{ old('idObject') }}>
    </div>
    <div class="form-group">
        <label for="idUser">Id of the user owning the task</label>
        <input required class="form-control" id="idUser" name="idUser" placeholder="Enter the user id" value={{ old('idUser') }}>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
