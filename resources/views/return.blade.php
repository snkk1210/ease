@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', 'Return Playbook')

<!-- ページの見出しを入力 -->
@section('content_header')
    <h1>Return Playbook</h1>
@stop

<!-- ページの内容を入力 -->
@section('content')
    <p>Return Playbook.</p>
                        <textarea readonly class="form-control" rows="100" name="main" class="form-control"><?php print_r($ansible_output) ?></textarea>
@stop

<!-- 読み込ませるCSSを入力 -->
@section('css')
    <link rel="stylesheet" href="/css/make.css">
@stop

<!-- 読み込ませるJSを入力 -->
@section('js')
    <script> console.log('Hi!'); </script>
@stop
