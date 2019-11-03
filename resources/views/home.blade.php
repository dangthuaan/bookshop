@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
    @include('includes.head')
@stop
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
    @include('includes.header')
	
	@yield('content')
</div>
@section('content')
    <p>You are logged in!</p>
@stop
