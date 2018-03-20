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

                    You are logged in dear {{ $user->username }}! Your role is {{ $user->getRole->name }}
                    <div class="container">
                        <p></p>
                        <p><a href="{{ route('accounts.index') }}">Accounts</a></p>
                        <p><a href="{{ route('ads.index') }}">Ads</a></p>
                        <p><a href="{{ route('adslist.index') }}">Ad lists</a></p>
                        <p><a href="{{ route('atts.index') }}">Attributes</a></p>
                        <p><a href="{{ route('autotasks.index') }}">Auto Tasks</a></p>
                        <p><a href="{{ route('contests.index') }}">Contests</a></p>
                        <p><a href="{{ route('diseases.index') }}">Diseases</a></p>
                        <p><a href="{{ route('diseasesLists.index') }}">Diseases list</a></p>
                        <p><a href="{{ route('horseatts.index') }}">Horse-Attribute relation list</a></p>
                        <p><a href="{{ route('horseclubs.index') }}">Horses clubs</a></p>
                        <p><a href="{{ route('horseindicators.index') }}">Horses indicators</a></p>
                        <p><a href="{{ route('horses.index') }}">Horses</a></p>
                        <p><a href="{{ route('indicators.index') }}">Indicators</a></p>
                        <p><a href="{{ route('infrastructures.index') }}">Infrastructures</a></p>
                        <p><a href="{{ route('injuries.index') }}">Injuries</a></p>
                        <p><a href="{{ route('injurieslists.index') }}">Injuries list</a></p>
                        <p><a href="{{ route('itemfamilies.index') }}">Item Families</a></p>
                        <p><a href="{{ route('itemslist.index') }}">Item list</a></p>
                        <p><a href="{{ route('items.index') }}">Items</a></p>
                        <p><a href="{{ route('news.index') }}">News</a></p>
                        <p><a href="{{ route('newslists.index') }}">News list</a></p>
                        <p><a href="{{ route('newspapers.index') }}">Newspapers</a></p>
                        <p><a href="{{ route('parasites.index') }}">Parasites</a></p>
                        <p><a href="{{ route('parasiteslists.index') }}">Parasite list</a></p>
                        <p><a href="{{ route('ridingstables.index') }}">Riding stables</a></p>
                        <p><a href="{{ route('shops.index') }}">Shops</a></p>
                        <p><a href="{{ route('users.index') }}">Users</a></p>
                        <p><a href="{{ route('usershops.index') }}">Users shops</a></p>
                        <p><a href="{{ route('weathers.index') }}">Weathers</a></p>
                        <p><a href="{{ route('weatherlists.index') }}">Weathers List</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
