@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', 'Welcome!!')

<!-- ページの見出しを入力 -->
@section('content_header')
    <h1>Welcome!!</h1>
@stop

<!-- ページの内容を入力 -->
@section('content')
    <p>こんにちは。{{ $user_name }} さん</p>

    <table>
        <tr>
            <th>Your Playbook</th>
            <th>Your Archive</th>
        </tr>
        <tr>
            <td><a href="/playbooks">{{ $enable_playbook_num }}</a></td>
            <td><a href="/archives">{{ $disable_playbook_num }}</a></td>
        </tr>
    </table>

    <footer>
　      <p>&copy; keisuke sanuki. 2021. version: 1.1.1</p> 
    </footer>
@stop

<!-- 読み込ませるCSSを入力 -->
@section('css')
    <link rel="stylesheet" href="/css/home.css">
@stop

<!-- 読み込ませるJSを入力 -->
@section('js')
    <script></script>
@stop
