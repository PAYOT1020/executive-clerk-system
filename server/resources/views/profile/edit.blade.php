@extends('adminlte::page')

@section('title', 'My Profile')

@section('content_header')
    <h1>
        <i class="fas fa-user"></i>
        My Profile
    </h1>
@stop

@section('content')

@if (session('status') === 'profile-updated')
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        Profile information updated successfully.
    </div>
@endif

<div class="row">

    {{-- Profile Information --}}
    <div class="col-md-6">

        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-edit"></i>
                    Profile Information
                </h3>
            </div>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="card-body">

                    <div class="form-group">
                        <label for="name">Name</label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}"
                            required
                        >

                        @error('name')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}"
                            required
                        >

                        @error('email')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>

                        <input
                            type="text"
                            id="role"
                            class="form-control"
                            value="{{ ucwords(str_replace('_', ' ', $user->role)) }}"
                            disabled
                        >

                        <small class="text-muted">
                            Your role is managed by the system administrator.
                        </small>
                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Save Changes
                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- Account Information --}}
    <div class="col-md-6">

        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-info-circle"></i>
                    Account Information
                </h3>
            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <tr>
                        <th width="180">Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>

                    <tr>
                        <th>Role</th>
                        <td>
                            <span class="badge badge-primary">
                                {{ ucwords(str_replace('_', ' ', $user->role)) }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th>Account Created</th>
                        <td>
                            {{ $user->created_at?->format('F d, Y') ?? '-' }}
                        </td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- Change Password --}}
<div class="row">

    <div class="col-md-6">

        <div class="card card-warning">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-lock"></i>
                    Change Password
                </h3>
            </div>

            <form method="POST" action="{{ route('password.update') }}">

                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="form-group">

                        <label for="current_password">
                            Current Password
                        </label>

                        <input
                            type="password"
                            name="current_password"
                            id="current_password"
                            class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                            required
                        >

                        @error('current_password', 'updatePassword')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div class="form-group">

                        <label for="password">
                            New Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                            required
                        >

                        @error('password', 'updatePassword')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                    <div class="form-group">

                        <label for="password_confirmation">
                            Confirm New Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="form-control"
                            required
                        >

                    </div>

                </div>

                <div class="card-footer">

                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-key"></i>
                        Update Password
                    </button>

                </div>

            </form>

        </div>

    </div>


</div>

@stop
