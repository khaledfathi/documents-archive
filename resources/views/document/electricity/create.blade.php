@extends('layout.main')
@section('title' , 'Create Electricity Doc')
@section ('links','')
@section ('sctipts','')
@section('sectionName', 'New Electricity Bill ')
@section('path')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('root') }}">Home</a></li>
        <li class="breadcrumb-item active">Documents</li>
        <li class="breadcrumb-item active"><a href="{{route('document.electricity.index')}}">Electricity</a></li>
        <li class="breadcrumb-item active">New Bill</li>
    </ol>
@endsection


@section('content')
@endsection