@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in dear {{ $user->pseudo }}! Your role is {{ $user->getRole() }}
                    <p>
                        <a href="{{ route('accounts.index') }}">Accounts</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
