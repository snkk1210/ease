@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1>Edit User</h1>
@stop

@section('content')
    <p>Edit User.</p>

    <form action="/update_user" method="POST">
        @csrf
        @method('POST')
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-nowrap">User</th>
                        <th class="text-nowrap">Role</th>
                    </tr>
                </thead>
                <tbody>
                    <td><input type="text" value="<?php echo $edit_user['name'] ?>" name="name" class="form-control" style="width:300px;" /></td>
                    <td><input type="text" value="<?php echo $edit_user['role'] ?>" name="role" class="form-control" style="width:300px;" /></td>
                </tbody>
            </table>
        </div>
        <input type="hidden" name="id" value="<?php echo $edit_user['id'] ?>">
        <input type="submit" value="Update" class="btn btn-success opbtn">
    </form>
    <form action="/remove_user" method="POST">
        @csrf
        @method('POST')
        <input type="hidden" name="id" value="<?php echo $edit_user['id'] ?>">
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
