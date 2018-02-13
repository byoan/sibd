@extends('layouts.app')

@section('content')

<h1>User #{{ $user->id }} edition</h1>
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

<form action="/users/{{ $user->id }}" method="POST">
    @method('PUT')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="username">Username</label>
        <input required class="form-control" id="username" name="username" value="{{ $user->username }}">
    </div>
    <div class="form-group">
        <label for="firstName">First name</label>
        <input required class="form-control" id="firstName" name="firstName" value="{{ $user->firstName }}">
    </div>
    <div class="form-group">
        <label for="lastName">Last name</label>
        <input required class="form-control" id="lastName" name="lastName" value="{{ $user->lastName }}">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input required class="form-control" id="email" name="email" type="email" placeholder="test@example.com" value="{{ $user->email }}">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea maxlength=200 aria-describedby="descriptionHelpBlock" required class="form-control" id="description" name="description">{{ $user->description }}</textarea>
        <small id="descriptionHelpBlock" class="form-text text-muted">200 characters max.</small>
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select required class="form-control" id="role" name="role">
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" name="{{ $role->name }}" {{ $role->id == $user->role ? 'selected' : ''}}>{{ ucfirst($role->name) }}</option>
            @endforeach
        </select>
    </div>
    <fieldset class="form-group">
        <label>Sex</label>
        <div class="form-group">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sex" id="sex1" value="M" {{ $user->sex == 'M' ? 'checked' : ''}}>
                <label class="form-check-label" for="sex1">
                    Male
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sex" id="sex2" value="F" {{ $user->sex == 'F' ? 'checked' : ''}}>
                <label class="form-check-label" for="sex2">
                    Female
                </label>
            </div>
        </div>
    </fieldset>
    <div class="form-group">
        <label for="birthDate">Birth date</label>
        <input required type="date" class="form-control" name="birthDate" id="birthDate" value="{{ $user->birthDate }}">
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <textarea class="form-control" aria-describedby="addressHelpBlock" id="address" name="address">{{ $user->address }}</textarea>
        <small id="addressHelpBlock" class="form-text text-muted">100 characters max.</small>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" minlength="10" maxlength="10" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
    </div>
    <div class="form-group">
        <label for="website">Website URL</label>
        <input class="form-control" id="website" name="website" value="{{ $user->website }}">
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
