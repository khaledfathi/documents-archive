@extends('layout.main')
@section('title', 'users')
@section('links', '')
@section('sctipts', '')
@section('sectionName', 'Users')
@section('path')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('root') }}">Home</a></li>
        <li class="breadcrumb-item active">Control Panel</li>
        <li class="breadcrumb-item active"><a href="{{route('users')}}">Users</a></li>
    </ol>
@endsection


@section('content')
    <div class="col d-block m-3">
        <a href="{{ route('createUser') }}" class="btn btn-block btn-primary btn-lg  col-2 " style="min-width:150px">New
            User</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Users Table</h3>
        </div>
        <!-- /.card-header -->

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible text-center">
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                {{$errors->first()}}
            </div>
        @endif
        {{-- / Error message  --}}

        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 overflow-auto">
                <div class="row">
                    <div class="col-sm-12 col-md-6"></div>
                    <div class="col-sm-12 col-md-6"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        {{$users->links()}}
                        <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                            aria-describedby="example2_info" style="min-width:700px">
                            <thead>
                                <tr>
                                    <th class="text-center sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-sort="ascending">
                                        User Name
                                    </th>
                                    <th class="text-center sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-sort="ascending">
                                        Image
                                    </th>

                                    <th class="text-center sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-sort="ascending">
                                        Email
                                    </th>
                                    <th class="text-center sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-sort="ascending">
                                        Type
                                    </th>
                                    <th width="5%"class="text-center sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-sort="ascending">
                                        Edit
                                    </th>
                                    </th>
                                    <th width="5%" class="text-center sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-sort="ascending">
                                        Delete
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="align-middle text-center">{{ $user->name }}</td>
                                        <td class="align-middle text-center">
                                            @if ($user->image)
                                                <img src="{{ asset('storage/upload/'.$user->image)  }}" alt="" width="50">
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">{{ $user->email }}</td>
                                        <td class="align-middle text-center">{{$user->type}}</td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('editUser', ['id' => $user->id]) }}">
                                                <i class="fas fa-edit fa-lg" style="color: #005eff;cursor:pointer;"></i>
                                            </a>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('destroyUser', ['id' => $user->id]) }}">
                                                <i class="fas fa-trash-alt fa-lg" style="color: #ff0000;cursor:pointer"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{$users->links()}}
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
