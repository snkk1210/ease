@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', 'Edit Playbook')

<!-- ページの見出しを入力 -->
@section('content_header')
    <h1>Edit Playbook</h1>
@stop

<!-- ページの内容を入力 -->
@section('content')
    <p>Edit Playbook.</p>

    <form action="/update_playbook" method="POST">
                        @csrf
                        @method('POST')
                        <div class="table-responsive">
                        <table id="matterTable" class="table table-striped table-bordered table-sm">
                        <thead class="thead-dark">
                            <tr>
                            <th class="text-nowrap">playbook名</th>
                            <th class="text-nowrap">レポジトリ名</th>
                            <th class="text-nowrap">有効</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td><input type="text" value="<?php echo $edit_playbook['name'] ?>" name="name" class="form-control" style="width:300px;" /></td>
                            <td><input type="text" value="<?php echo $edit_playbook['repository'] ?>" name="repository" class="form-control" style="width:300px;" /></td>
                            <td>
                                <select name="enable_flag" id="model" class="form-control">
                                    <option value="0">有効</option>
                                    <option value="1">無効</option>
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
                        <textarea class="form-control" rows="10" name="vars" class="form-control"><?php echo $edit_playbook['vars'] ?></textarea>
                        <label for="textarea1">main:</label>
                        <textarea class="form-control" rows="10" name="main" class="form-control"><?php echo $edit_playbook['main'] ?></textarea>
                        <input type="submit" value="更新" class="btn btn-success">
    </form>
@stop

<!-- 読み込ませるCSSを入力 -->
@section('css')
    <link rel="stylesheet" href="/css/make.css">
@stop

<!-- 読み込ませるJSを入力 -->
@section('js')
    <script> console.log('Hi!'); </script>
@stop
