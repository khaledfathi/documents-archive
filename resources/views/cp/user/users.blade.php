@extends('layout.main')
@section('title', 'users')
@section('links', '')
@section('sctipts', '')
@section('sectionName', 'Users')
@section('path')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('root') }}">Home</a></li>
        <li class="breadcrumb-item active">Control Panel</li>
        <li class="breadcrumb-item active">Users</li>
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
                        <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                            aria-describedby="example2_info" style="min-width:700px">
                            <thead>
                                <tr>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-sort="ascending">
                                        User Name
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-sort="ascending">
                                        Image
                                    </th>

                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-sort="ascending">
                                        Email
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-sort="ascending">
                                        Type
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-sort="ascending">
                                        View
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-sort="ascending">
                                        Edit
                                    </th>
                                    </th>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                        colspan="1" aria-sort="ascending">
                                        Delete
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            @if ($user->image)
                                                <img src="{{ asset($user->image) }}" alt="" width="50">
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>Type</td>
                                        <td>View</td>
                                        <td>
                                            <a href="{{ route('editUser', ['id' => $user->id]) }}">
                                                <i class="fas fa-edit fa-lg" style="color: #005eff;cursor:pointer;"></i>
                                            </a>
                                        </td>
                                        <td>
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
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of
                            57 entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="example2_previous"><a
                                        href="#" aria-controls="example2" data-dt-idx="0" tabindex="0"
                                        class="page-link">Previous</a></li>
                                <li class="paginate_button page-item active"><a href="#" aria-controls="example2"
                                        data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                        data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                        data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                        data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                        data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="example2"
                                        data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                <li class="paginate_button page-item next" id="example2_next"><a href="#"
                                        aria-controls="example2" data-dt-idx="7" tabindex="0"
                                        class="page-link">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
