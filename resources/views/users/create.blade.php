@extends('layouts.app')

@section('content')

<h1>Create User</h1>
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

<form action="/users" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="username">Username</label>
        <input required class="form-control" id="username" name="username" placeholder="Enter a username" value={{ old('username') }}>
    </div>
    <div class="form-group">
        <label for="firstName">First name</label>
        <input required class="form-control" id="firstName" name="firstName" placeholder="Enter a first name" value={{ old('firstName') }}>
    </div>
    <div class="form-group">
        <label for="lastName">Last name</label>
        <input required class="form-control" id="lastName" name="lastName" placeholder="Enter a last name" value={{ old('lastName') }}>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input required class="form-control" id="email" name="email" type="email" placeholder="test@example.com" value={{ old('email') }}>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input required class="form-control" id="password" name="password" type="password" placeholder="Enter a password" value={{ old('password') }}>
    </div>
    <div class="form-group">
        <label for="passwordConfirmation">Password confirmation</label>
        <input required class="form-control" id="passwordConfirmation" name="passwordConfirmation" type="password" placeholder="Confirm the password" value={{ old('passwordConfirmation') }}>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea maxlength=200 aria-describedby="descriptionHelpBlock" required class="form-control" id="description" name="description">{{ old('description') }}</textarea>
        <small id="descriptionHelpBlock" class="form-text text-muted">200 characters max.</small>
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select required class="form-control" id="role" name="role" value={{ old('role') }}>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" name="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
            @endforeach
        </select>
    </div>
    <fieldset class="form-group">
        <label>Sex</label>
        <div class="form-group">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sex" id="sex1" value="M">
                <label class="form-check-label" for="sex1">
                    Male
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="sex" id="sex2" value="F">
                <label class="form-check-label" for="sex2">
                    Female
                </label>
            </div>
        </div>
    </fieldset>
    <div class="form-group">
        <label for="birthDate">Birth date</label>
        <input required type="date" class="form-control" name="birthDate" id="birthDate" value={{ old('birthDate') }}>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <textarea class="form-control" aria-describedby="addressHelpBlock" id="address" name="address">{{ old('address') }}</textarea>
        <small id="addressHelpBlock" class="form-text text-muted">100 characters max.</small>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" minlength="10" maxlength="10" class="form-control" id="phone" name="phone" value={{ old('phone') }}>
    </div>
    <div class="form-group">
        <label for="website">Website URL</label>
        <input class="form-control" id="website" name="website" placeholder="https://google.fr" value={{ old('website') }}>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
