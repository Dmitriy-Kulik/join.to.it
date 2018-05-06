@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                @include('components.sidebar')
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        <h1 class="text-center">Add user</h1>
                        <form method="post" action="{{ route('is_super_admin.dashboard.store') }}">
                            {{ csrf_field() }}
                            <div class="form group">
                                <label for="first_name">First name:</label>
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>
                            </div>
                            <div class="form group">
                                <label for="last_name">Last name:</label>
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>
                            </div>
                            <div class="form group">
                                <label for="email">Email:</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="form group">
                                <label for="password">Password:</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            </div>
                            <div class="form group">
                                <label for="password">Confirm Password:</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>

                            <div class="form group">
                                <label for="role">Role:</label>
                                <select id="role" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" required>
                                    <option></option>
                                    <option>super_admin</option>
                                    <option>admin</option>
                                    <option>manager</option>
                                    <option>user</option>
                                </select>
                            </div>

                            <div class="form group">
                                <label for="url_avatar">Avatar:</label>
                                <input id="url_avatar" type="text" class="form-control{{ $errors->has('url_avatar') ? ' is-invalid' : '' }}" name="url_avatar" value="{{ old('url_avatar') }}" required>
                            </div>
                            <br>
                            <div>
                                <input class="btn btn-primary form-control" type="submit" value="Add user">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection