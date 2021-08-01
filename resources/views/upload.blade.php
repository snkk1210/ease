@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', 'Upload Files')

<!-- ページの見出しを入力 -->
@section('content_header')
    <h1>Upload Files</h1>
@stop

<!-- ページの内容を入力 -->
@section('content')
    <p>Upload Files</p>

    <form method="POST" action="/store" enctype="multipart/form-data">
        @csrf
        <td><input type="text" value="" name="directory" class="form-control" style="width:300px;" /></td>
        <input type="file" id="file" name="file[]" multiple>
        <input type="submit" value="upload">
    </form>

    <form method="POST" action="/show" enctype="multipart/form-data">
        @csrf
        <td><input type="text" value="" name="directory" class="form-control" style="width:300px;" /></td>
        <input type="submit" value="show">
    </form>
@stop

<!-- 読み込ませるCSSを入力 -->
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

<!-- 読み込ませるJSを入力 -->
@section('js')
    <script></script>
@stop