@extends('layouts.admin')
<style>
    .center {
        margin: auto;
    }

    .text-center {
        text-align: center;
    }
</style>
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="list-group">
                        <a href="#" class="list-group-item">Profile</a>
                        <a href="#" class="list-group-item active">Account Settings</a>
                        <a href="#" class="list-group-item">Notifications</a>
                        <a href="#" class="list-group-item">Subscription</a>
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header bg-light">
                            Account Settings
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form action="{{ route('userProfilePost') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row mb-5">
                                    <div class="col-md-4 mb-4">
                                        <div>Profile Information</div>
                                        <div class="text-muted small">These information are visible to the public.</div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">Name</label>
                                                    <input name="name"
                                                           class="form-control @error('name') is-invalid @enderror"
                                                           value="{{ Auth::user()->name }}">
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-control-label">Email Address</label>
                                                    <input name="email"
                                                           class="form-control @error('email') is-invalid @enderror""
                                                    value="{{ Auth::user()->email }}">
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                         <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="col-md-4 mb-4 text-center center">
                                    <div>Access Credentials</div>
                                    <div class="text-muted small">Leave credentials fields empty if you don't wish to
                                        change the password.
                                    </div>
                                </div>

                                <div class="row mt-5 ">


                                    <div class="col-md-8 center">
                                        <div class="row">
                                            <div class="col-md-6 center text-center">
                                                <div class="form-group">
                                                    <label class="form-control-label">Current Password</label>
                                                    <input name="password" type="password" class="form-control"
                                                           placeholder="Current Password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">


                                            <div class="col-md-6 text-center">
                                                <div class="form-group">
                                                    <label class="form-control-label">New Password</label>
                                                    <input name="new_password" type="password" class="form-control"
                                                           placeholder="New Password">
                                                </div>
                                            </div>

                                            <div class="col-md-6 text-center">
                                                <div class="form-group">
                                                    <label class="form-control-label">New Password Confirmation</label>
                                                    <input name="new_password_confirmation" type="password"
                                                           class="form-control"
                                                           placeholder="Password Confirmation">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-light text-right">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
