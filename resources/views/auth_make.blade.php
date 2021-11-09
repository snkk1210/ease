@extends('adminlte::page')

@section('title', 'Make Authentication')

@section('content_header')
    <h1>Make Authentication</h1>
@stop

@section('content')
    <p>Make Authentication.</p>

    <form action="/register_auth" method="POST">
        @csrf
        @method('POST')
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-nowrap">認証名</th>
                        <th class="text-nowrap">パスワード</th>
                    </tr>
                </thead>
                <tbody>
                    <td><input type="text" name="auth_name" class="form-control" style="width:300px;" /></td>
                    <td><input type="text" name="ssh_pass" class="form-control" style="width:300px;" /></td>
                </tbody>
            </table>
        </div>
        <label for="textarea1">private_key:</label>
        <textarea class="form-control" rows="10" name="ssh_key" class="form-control"></textarea>
        <input type="hidden" name="a_owner_id" value="{{ $a_owner_id }}">
        <input type="submit" value="作成" class="btn btn-success">
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/make.css">
@stop

@section('js')

@stop
