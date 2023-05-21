@extends('layout.main')
@section('title', 'Create User')
@section('links', '')
@section('scripts')
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
@section('sectionName', 'New User')
@section('path')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('root') }}">Home</a></li>
        <li class="breadcrumb-item active">Control Panel</li>
        <li class="breadcrumb-item active"><a href="{{ route('users') }}">Users</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
@endsection


@section('content')
    <div class="card card-primary mx-auto col-8 ">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i>Error</h5>
                @foreach ($errors->all() as $error)
                    - {{ $error }}<br>
                @endforeach
            </div>
        @endif
        <div class="card-header">
            <h3 class="card-title">Create New User</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('storeUser') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">User name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="User name"
                        name="name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email"
                        name="email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
                        name="password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Contirm password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confitm password"
                        name="password_confirmation">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Profile Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" accept="image/*"
                                name="image">
                            <label class="custom-file-label" for="exampleInputFile">Choose File</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>User Type</label>
                    <select class="form-control" name="type">
                        @foreach ($userTypes as $type)
                            <option value="{{ $type->value }}">{{ $type->value }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-primary  w-25 " style="min-width:100px">Submit</button>
            </div>
        </form>
    </div>
@endsection
