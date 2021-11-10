@extends('adminlte::page')

@section('title', 'Edit Authentication')

@section('content_header')
    <h1>Edit Authentication</h1>
@stop

@section('content')
    <p>Edit Authentication.</p>

    <form action="/update_auth" method="POST">
        @csrf
        @method('POST')
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-nowrap">Auth</th>
                        <th class="text-nowrap">Password</th>
                    </tr>
                </thead>
                <tbody>
                    <td><input type="text" value="<?php echo $edit_auth['auth_name'] ?>" name="auth_name" class="form-control" style="width:300px;" /></td>
                    <td><input type="text" value="<?php echo $edit_auth['ssh_pass'] ?>" name="ssh_pass" class="form-control" style="width:300px;" /></td>
                </tbody>
            </table>
        </div>
        <label for="textarea1">private_key :</label>
        <textarea class="form-control" rows="10" name="ssh_key" class="form-control"><?php echo $edit_auth['ssh_key'] ?></textarea>
        <input type="hidden" name="id" value="<?php echo $edit_auth['id'] ?>">
        <input type="submit" value="Update" class="btn btn-success opbtn">
    </form>
    <form action="/remove_auth" method="POST">
        @csrf
        @method('POST')
        <input type="hidden" name="id" value="<?php echo $edit_auth['id'] ?>">
        <input type="submit" value="Delete" class="btn btn-danger opbtn" onClick="delete_alert(event);return false;">
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/make.css">
    <link rel="stylesheet" href="/css/btn.css">
@stop

@section('js')
    <script src="js/alert.js"></script>
@stop
