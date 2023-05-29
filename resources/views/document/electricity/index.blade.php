@extends('layout.main')
@section('title', 'Electricity-Docs')
@section('links', '')
@section('scripts', '')
@section('styles','')
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
        <a href="{{route('document.electricity.create')}}" class="btn btn-block btn-primary btn-lg  col-2 " style="min-width:120px">
            New Bill</a>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Electricity Bills for year 2023</h3>
        </div>
        <!-- /.card-header -->
        {{-- find year --}}
        <div class="col-md-4 mt-3 mx-auto">
            <form action="simple-results.html">
                <div class="input-group">
                    <input type="number" class="form-control form-control-lg" placeholder="Type the year" min=1900 max=9999>
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
                                        Month
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
                                <tr>
                                    <td class="align-middle text-center">January</td>
                                    <td class="align-middle text-center">2023/02/04</td>
                                    <td class="align-middle text-center">244</td>
                                    <td class="align-middle text-center">300</td>
                                    <td class="align-middle text-center">ImageIcon</td>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

    <p>table report avg paying/mont - avg consumtion (min, max , avg)</p>
    
    <h3>new bill</h3>
    <p>relase data</p>
    <p>months count</p>
    <p>monthe/s + add button for more than 1 </p>
    <p>consumption - kw/h</p>
    <p>bill value</p>
    <p>bill image </p>
    <p>other details</p>
@endsection
