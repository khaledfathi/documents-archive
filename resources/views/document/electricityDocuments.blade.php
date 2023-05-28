@extends('layout.main')
@section('title' , 'Electricity-Docs')
@section ('links','')
@section ('sctipts','')
@section('sectionName', 'Electricity')
@section('path')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('root') }}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{route('electricityDocuments')}}">Electricity Docs</a></li>
    </ol>
@endsection


@section('content')
<h3>buttons</h3>
<p>find - new bill - (view this year)</p>

<h3>new bill</h3>
<p>relase data</p>
<p>months count</p>
<p>monthe/s + add button for more than 1 </p>
<p>consumption - kw/h</p>
<p>bill value</p>
<p>bill image </p>
<p>other details</p>

<h3>find</h3>
<p>show whole year - select year</p>
<p>select month</p>
<p>select year</p>
<p>period month/year to month/year</p>


@endsection