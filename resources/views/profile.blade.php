@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', 'Profile')

<!-- ページの見出しを入力 -->
@section('content_header')
    <h1>Profile</h1>
@stop

<!-- ページの内容を入力 -->
@section('content')
    <h4>name</h4>
    {{ $name }}
    <h4>email</h4>
    {{ $email }}
@stop

<!-- 読み込ませるCSSを入力 -->
@section('css')
    <link rel="stylesheet" href="/css/make.css">
@stop

<!-- 読み込ませるJSを入力 -->
@section('js')
    <script> console.log('Hi!'); </script>
@stop
