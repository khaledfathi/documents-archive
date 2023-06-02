@extends('layout.main')
@section('title' , 'Dashboard-All')
@section ('links','')
@section ('sctipts','')
@section('sectionName', 'Dashboard')
@section('path')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('root') }}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">All</li>
    </ol>
@endsection


@section('content')
@endsection