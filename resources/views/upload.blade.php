@extends('adminlte::page')

@section('title', 'Upload Files')

@section('content_header')
    <h1>Upload Files</h1>
@stop

@section('content')
    <p>Upload Files</p>

    <form method="POST" action="/store" enctype="multipart/form-data" id="upload-form">
        <p id="upload-title">ファイルアップロード</p>
        @csrf
        <td><input type="text" value="" name="directory" class="form-control" id="upload-input" /></td>
        <input type="file" id="file" name="file[]" onchange="selectFile()" multiple>
        <input type="submit" value="upload" id="upload-button">
    </form>

    <form method="POST" action="/show" enctype="multipart/form-data" id="show-form">
        <p id="show-title">ファイル確認</p>
        @csrf
        <td><input type="text" value="" name="directory" class="form-control" id="show-input" /></td>
        <input type="submit" value="ファイル表示" id="show-button">
    </form>

    @if(isset( $lists ))
    @foreach ($lists as $list)
        <p id="show-list">{!! nl2br(e($list)) !!}</p>
    @endforeach
    @endif

@stop

@section('css')
    <link rel="stylesheet" href="/css/upload.css">
@stop

@section('js')
    <script>
        window.onload = function(){
            document.getElementById("upload-button").disabled = true;
        }

        function selectFile(){
            if (document.getElementById("file").value === ""){
                document.getElementById("upload-button").disabled = true;
            } else {
                document.getElementById("upload-button").disabled = false;
            }
        }
    </script>
@stop