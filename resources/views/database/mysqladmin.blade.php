@extends('layouts.app')

@section('content')
    <h1>MySqlAdmin {{ $title }}</h1>

    <code>
        {!! nl2br(e($logs)) !!}
    </code>
@endsection
