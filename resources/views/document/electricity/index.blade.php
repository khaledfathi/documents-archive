@extends('layout.main')
@section('title', 'Electricity-Docs')
@section('links', '')
@section('scripts', '')
@section('styles', '')
@section('sectionName', 'Electricity')
@section('path')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('root') }}">Home</a></li>
        <li class="breadcrumb-item">Documents</li>
        <li class="breadcrumb-item active"><a href="{{ route('document.electricity.index') }}">Electricity Docs</a></li>
    </ol>
@endsection

@section('content')
    <div class="col d-block m-3">
        <a href="{{ route('document.electricity.create') }}" class="btn btn-block btn-primary btn-lg  col-2 "
            style="min-width:120px">
            New Bill</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Electricity Bills for year 2023</h3>
        </div>
        <!-- /.card-header -->
        {{-- find year --}}
        <div class="col-md-4 mt-3 mx-auto">
            <form action="{{route('document.electricity.index')}}">
                <div class="input-group">
                    <input type="number" class="form-control form-control-lg" placeholder="Type the year" min=1900
                        max=9999 name="year">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-lg btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        {{-- / find year --}}

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
                                    <th class="text-center sorting sorting_asc" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-sort="ascending">
                                        Month / Year
                                    </th>
                                    <th class="text-center sorting sorting_asc" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-sort="ascending">
                                        Relase Date
                                    </th>
                                    <th class="text-center sorting sorting_asc" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-sort="ascending">
                                        Consumption KW/H
                                    </th>
                                    <th class="text-center sorting sorting_asc" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-sort="ascending">
                                        Bill Value EGP
                                    </th>

                                    <th class="text-center sorting sorting_asc" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-sort="ascending">
                                        Bill Image
                                    </th>
                                    <th class="text-center sorting sorting_asc" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-sort="ascending">
                                        Edit
                                    </th>
                                    <th class="text-center sorting sorting_asc" tabindex="0" aria-controls="example2"
                                        rowspan="1" colspan="1" aria-sort="ascending">
                                        Delete
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bills as $bill)
                                    <tr>
                                        <td class="align-middle text-center">{{ MONTHS[$bill->month - 1] }} /
                                            {{ $bill->year }}</td>
                                        <td class="align-middle text-center">{{ $bill->release_date }}</td>
                                        <td class="align-middle text-center">{{ $bill->consumption }}</td>
                                        <td class="align-middle text-center">{{ $bill->amount }}</td>
                                        <td class="align-middle text-center">{{ $bill->image }}</td>
                                        <td class="align-middle text-center">
                                            <a href="">
                                                <i class="fas fa-edit fa-lg" style="color: #005eff;cursor:pointer;"></i>
                                            </a>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="">
                                                <i class="fas fa-trash-alt fa-lg" style="color: #ff0000;cursor:pointer"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>


    <p>remaining : </p>
    <ul>
        <li>uploading image in new bill</li>
        <li>image buton and image page in index page</li>
        <li>show min max avg for consumption and amount</li>
        <li></li>
    </ul>
@endsection
