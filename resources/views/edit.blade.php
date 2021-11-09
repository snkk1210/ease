@extends('adminlte::page')

@section('title', 'Edit Playbook')

@section('content_header')
    <h1>Edit Playbook</h1>
@stop

@section('content')
    <p>Edit Playbook.</p>

    <form action="/update_playbook" method="POST">
        @csrf
        @method('POST')
        <div class="table-responsive">
            <table id="matterTable" class="table table-striped table-bordered table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-nowrap">Playbook名</th>
                        <th class="text-nowrap">リポジトリ</th>
                        <th class="text-nowrap">認証</th>
                    </tr>
                </thead>
                <tbody>
                    <td><input type="text" value="<?php echo $edit_playbook['name'] ?>" name="name" class="form-control" style="width:300px;" /></td>
                    <td><input type="text" value="<?php echo $edit_playbook['repository'] ?>" name="repository" class="form-control" style="width:300px;" /></td>
                    <td>
                        <select name="auth_id" id="model" class="form-control">
                            @foreach($authes as $index => $name)
                                @if ($name->id == $edit_playbook['auth_id'])
                                    <option value="{{ $name->id }}" selected><?php echo $name->auth_name ?></option>
                                @else
                                    <option value="{{ $name->id }}"><?php echo $name->auth_name ?></option>
                                @endif
                            @endforeach
                        </select>   
                    </td>
                </tbody>
            </table>
        </div>
        <label for="textarea1">private_key:</label>
        <textarea class="form-control" rows="10" name="private_key" class="form-control"><?php echo $edit_playbook['private_key'] ?></textarea>
        <label for="textarea1">inventory:</label>
        <textarea class="form-control" rows="10" name="inventory" class="form-control"><?php echo $edit_playbook['inventory'] ?></textarea>
        <label for="textarea1">vars:</label>
        <textarea class="form-control" rows="10" name="vars" class="form-control" id="var-editor"><?php echo $edit_playbook['vars'] ?></textarea>
        <label for="textarea1">main:</label>
        <textarea class="form-control" rows="10" name="main" class="form-control" id="txt-editor"><?php echo $edit_playbook['main'] ?></textarea>
        <input type="hidden" name="id" value="<?php echo $edit_playbook['id'] ?>">
        <input type="submit" value="更新" class="btn btn-success">
    </form>
    <form action="/remove_playbook" method="POST">
        @csrf
        @method('POST')
        <input type="hidden" name="id" value="<?php echo $edit_playbook['id'] ?>">
        <input type="submit" value="削除" class="btn btn-danger" onClick="delete_alert(event);return false;">
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="lib/codemirror.css">
    <link rel="stylesheet" href="/css/make.css">
@stop

@section('js')
    <script src="js/alert.js"></script>
    <script src="lib/codemirror.js"></script>
    <script src="mode/javascript/javascript.js"></script>
    <script src="js/textarea.js"></script>
@stop
