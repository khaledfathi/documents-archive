@extends('layout.main')
@section('title', 'Water-Docs')
@section('links', '')
@section('scripts', '')
@section('styles', '')
@section('sectionName', 'Water')
@section('path')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('root') }}">Home</a></li>
        <li class="breadcrumb-item">Documents</li>
        <li class="breadcrumb-item active"><a href="{{ route('document.water.index') }}">Water</a></li>
    </ol>
@endsection

@section('content')
    <div class="col d-block m-3">
        <a href="{{ route('document.water.create') }}" class="btn btn-block btn-primary btn-lg  col-2 "
            style="min-width:120px">
            New Bill</a>
    </div>
    @if (session('ok'))
        <div class="alert alert-success alert-dismissible"$>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i>Updated</h5>
            {{ session('ok') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Water Bills for year {{ $currentYear }}</h3>
        </div>
        <!-- /.card-header -->
        {{-- find year --}}
        <div class="col-md-4 mt-3 mx-auto">
            <form action="{{ route('document.water.index') }}">
                <div class="input-group">
                    <input type="number" class="form-control form-control-lg" placeholder="Type the year" min=1900 max=9999
                        name="year" value="{{ $currentYear }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-lg btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                        <a href="{{ route('document.water.index') . '?year=' . CURRENT_YEAR }}"
                            class="btn btn-lg btn-default ml-3">
                            {{ CURRENT_YEAR }}
                        </a>
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
                            aria-describedby="example2_info" style="min-width:800px">
                            <thead>
                                <tr>
                                    <th class="text-center sorting sorting_asc align-middle " tabindex="0"
                                        aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">
                                        Month / Year
                                    </th>
                                    <th class="text-center sorting sorting_asc align-middle" tabindex="0"
                                        aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">
                                        Relase Date
                                    </th>
                                    <th class="text-center sorting sorting_asc align-middle" tabindex="0"
                                        aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending"
                                        width="15%">
                                        Consumption M<sup>3</sup>
                                    </th>
                                    <th class="text-center sorting sorting_asc align-middle" tabindex="0"
                                        aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending"
                                        width="15%">
                                        Bill Value EGP
                                    </th>

                                    <th class="text-center sorting sorting_asc align-middle" tabindex="0"
                                        aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending"
                                        width="10%">
                                        Bill Image
                                    </th>
                                    <th class="text-center sorting sorting_asc align-middle" tabindex="0"
                                        aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending"
                                        width="5%">
                                        Edit
                                    </th>
                                    <th class="text-center sorting sorting_asc align-middle" tabindex="0"
                                        aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending"
                                        width="5%">
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
                                        <td class="align-middle text-center">
                                            <a href="{{ asset('storage/water/' . $bill->image) }}">
                                                <i class="far fa-image fa-lg" style="color: #1a5fb4;"></i>
                                            </a>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('document.water.edit', $bill->id) }}">
                                                <i class="fas fa-edit fa-lg" style="color: #005eff;cursor:pointer;"></i>
                                            </a>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('document.water.destroy', $bill->id) }}">
                                                <i class="fas fa-trash-alt fa-lg"
                                                    style="color: #ff0000;cursor:pointer"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex flex-row flex-wrap col-12 justify-content-center flex-wrap" >
                        <div class="info-box mb-3 bg-info mx-2 col-5" style="min-width:300px">
                            <span class="info-box-icon"><i class="fas fa-faucet fa-lg"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text" style="font-weight:bold;font-size:13pt;">Counsumption</span>
                                <span class="info-box-number">Min : {{$consumptionStatistics->min}} KW/H</span>
                                <span class="info-box-number">Max : {{$consumptionStatistics->max}} KW/H</span>
                                <span class="info-box-number">Avg : {{$consumptionStatistics->avg}} KW/H</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <div class="info-box mb-3 bg-info mx-2 col-5" style="min-width:300px">
                            <span class="info-box-icon"><i class="fas fa-dollar-sign fa-lg"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text" style="font-weight:bold;font-size:13pt;">Bil Value</span>
                                <span class="info-box-number">Min : {{$amountStatistics->min}} EGP</span>
                                <span class="info-box-number">Max : {{$amountStatistics->max}} EGP</span>
                                <span class="info-box-number">Avg : {{$amountStatistics->avg}} EGP</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
