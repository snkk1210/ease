@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', 'Dashboard')

<!-- ページの見出しを入力 -->
@section('content_header')
    <h1>Dashboard</h1>
@stop

<!-- ページの内容を入力 -->
@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

<!-- 読み込ませるCSSを入力 -->
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

<!-- 読み込ませるJSを入力 -->
@section('js')
    <script> console.log('Hi!'); </script>
@stop
