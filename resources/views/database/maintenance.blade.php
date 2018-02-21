@extends('layouts.app')

@section('content')
    <h1>Maintenance operation</h1>
    <h2>{{ $name }}</h2>

    <code>
        {!! nl2br(e($result)) !!}
    </code>
@endsection
