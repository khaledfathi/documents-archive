@extends('layout.main')
@section('title', 'About')
@section('links', '')
@section('sctipts', '')
@section('sectionName', 'About')
@section('path')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('root') }}">Home</a></li>
        <li class="breadcrumb-item active">Control Panel</li>
        <li class="breadcrumb-item active">About</li>
    </ol>
@endsection


@section('content')
    <div class="alert alert-info alert-dismissible col-lg-8 col-sm-12 m-auto ">
        <h3><i class="icon fas fa-info"></i> About Application</h3>
        <h5>- Documents Archive Application - </h5>
        <p style="font-size:15pt;">
            is a simple application to manage your home documents such as invoices , for example :
            invoices of electricity , water , gas , land line ... etc , also it can handle general Documents like :
            Legal docs , medical docs , educational docs such as certificates ... etc .
        </p>
        <p style="font-size:15pt;">
            it's support multi users , and support database import and export,
        </p>
        <p style="font-size:15pt;">
            moreover it has a charts to analysis your all deffrent data .
        </p>
    </div>

    <div class="alert alert-info alert-dismissible bg-light col-lg-4 col-sm-12  mt-3 mx-auto" >
        <p style="font-size:15pt;">
            App Verstion : pre-alpha
        </p>
        <p style="font-size:15pt;">
            License : GPL v3
        </p>
        <p style="font-size:15pt;">
            Support : dev@khaledfathi.com
        </p>
        <p style="font-size:15pt;">
            PHP Version : {{phpVersion()}}
        </p>
        <p style="font-size:15pt;">
            Laravel Version : {{app()->version()}} 
        </p>
        <a href="{{route('documentaions')}}">Source Code Documentaions</a>
    </div>
@endsection
