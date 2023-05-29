@extends('layout.main')
@section('title', 'User Profile')
@section('links', '')
@section('scripts', '')
@section('sectionName', 'User Profile')
@section('path')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('root') }}">Home</a></li>
        <li class="breadcrumb-item active">My Account</li>
    </ol>
@endsection


@section('content')
    @if ($errors->any())
        {{-- Errors --}}
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
            @foreach ($errors->all() as $error)
                - {{ $error }}<br>
            @endforeach
        </div>
        {{-- / Errors --}}
    @elseif(session('ok'))
        {{--  OK --}}
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            {{ session('ok') }}
        </div>
        {{--  / OK --}}
    @endif
    <div class="card card-widget widget-user shadow">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-info">
            <h3 class="widget-user-username">{{ auth()->user()->name }}</h3>
            <h5 class="widget-user-desc">{{ auth()->user()->email }}</h5>
        </div>
        <div class="widget-user-image">
            <img class="img-circle elevation-2" style="background:white"
                src="{{ auth()->user()->image ? asset('storage/upload/' . auth()->user()->image) : asset(DEFAULT_USER_IMAGE) }}">
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header"><a href="#change-email" class="text-primary">Change Email</a></h5>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header"><a href="#change-password" class="text-primary">Change Password</a>
                        </h5>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                    <div class="description-block">
                        <h5 class="description-header"><a href="#delete-account" class="text-danger">Delete Account</a></h5>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>

        {{-- Logging --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Login History</h3>
            </div>
            <div class="m-3">
                {{ $userLogs->links() }}
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>IP Address</th>
                            <th>Agent</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userLogs as $log)
                            <tr>
                                <td>{{ $log->time }}</td>
                                <td>{{ $log->ip_address }}</td>
                                <td>{{ $log->user_agent }}</td>
                                <td class="align-middle text-center">
                                    <a href="{{route('profile.destroyUserLog',$log->id)}}">
                                        <i class="fas fa-trash-alt fa-lg" style="color: #ff0000;cursor:pointer"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('profile.clearUserLogs') }}" class="btn btn-danger m-3" style="width:100px">Clear Logs</a>
            </div>
            <!-- /.card-body -->

        </div>
        {{-- / Logging --}}

        {{-- change email form card --}}
        <div class="card card-primary" id="change-email">
            <div class="card-header">
                <h3 class="card-title">Change Email</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('profile.updateEmail') }}" method="get">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Your Email address</label>
                        <span class="mx-4">{{ auth()->user()->email }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">New Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="New email"
                            name="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Confirm Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Confirm email"
                            name="email_confirmation">
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary w-25" style="min-width:150px;">Update</button>
                </div>
            </form>
        </div>
        {{-- / change email form card --}}

        {{-- change password form card --}}
        <div class="card card-primary" id="change-password">
            <div class="card-header">
                <h3 class="card-title">Change Password</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('profile.updatePassword') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Old Password</label>
                        <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Old Password"
                            name="old_password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">New Password</label>
                        <input type="password" class="form-control" id="exampleInputEmail1"
                            placeholder="8 characters or more " name="password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">confirm Password</label>
                        <input type="password" class="form-control" id="exampleInputEmail1"
                            placeholder="Confirm password " name="password_confirmation">
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-primary w-25" style="min-width:150px;">Update</button>
                </div>
            </form>
        </div>
        {{-- / change password form card --}}

        {{-- change delete account form card --}}
        <div class="card card-danger" id="delete-account">
            <div class="card-header">
                <h3 class="card-title">Deleta Account</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('profile.deleteAccount') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">USE YOU PASSWORD FOR DELETE CONFIRMATION</label>
                        <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Your password"
                            name="password">
                    </div>
                </div>
                <h5 class="text-center">all data related to this account will be destroy<br>There's no way to undo this
                    step !</h5>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-danger w-25" style="min-width:150px;">Delete Account</button>
                </div>
            </form>
        </div>
        {{-- / change delete account form card --}}
    </div>
@endsection
