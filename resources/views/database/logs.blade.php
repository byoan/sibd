@extends('layouts.app')


@section('content')

<h1>MySQL {{$title}} Logs</h1>

@foreach ($logs as $row)
    <code>{{ $row }}</code><br />
@endforeach

@endsection
