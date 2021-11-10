@extends('adminlte::page')

@section('title', 'Return Playbook')

@section('content_header')
    <h1>Return Playbook</h1>
@stop

@section('content')
    <p>Return Playbook.</p>
    <textarea readonly class="form-control" rows="100" name="main" class="form-control"><?php print_r($ansible_output) ?></textarea>
@stop

@section('css')
    <link rel="stylesheet" href="/css/make.css">
@stop

@section('js')

@stop
