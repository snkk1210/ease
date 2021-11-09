@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1>Profile</h1>
@stop

@section('content')
    <h4>name</h4>
    {{ $name }}
    <h4>email</h4>
    {{ $email }}
@stop

@section('css')
    <link rel="stylesheet" href="/css/make.css">
@stop

@section('js')

@stop
