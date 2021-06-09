@extends('errors::illustrated-layout')

@section('title', __('SERVER ERROR'))
@section('code', '500')
@section('message', $exception->getMessage())
