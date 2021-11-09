@extends('adminlte::page')

@section('title', 'Welcome!!')

@section('content_header')
    <h1>Welcome!!</h1>
@stop

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
　      <p>&copy; keisuke sanuki. 2021. version: 1.1.4</p> 
    </footer>
@stop

@section('css')
    <link rel="stylesheet" href="/css/home.css">
@stop

@section('js')
    <script></script>
@stop
