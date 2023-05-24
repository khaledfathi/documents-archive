@extends('layout.main')
@section('title', 'User Profile')
@section('links', '')
@section('sctipts', '')
@section('sectionName', 'User Profile')
@section('path')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('root') }}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profile') }}">Profile</a></li>
    </ol>
@endsection


@section('content')
<p>Change Password</p>
<p>Change Email</p>
<p>Delete My Account</p>
<p>Change Profile Picture [by clicking on picture]</p>
<p>table of login informaion [login data-time , ip , OS , Browser ]</p>
@endsection
