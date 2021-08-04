@extends('errors::illustrated-layout')

@section('title', __('Bad Request'))
@section('code', '400')
@section('message', __($exception->getMessage()))