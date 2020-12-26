@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', 'Exec Playbook')

<!-- ページの見出しを入力 -->
@section('content_header')
    <h1>Exec Playbook</h1>
@stop

<!-- ページの内容を入力 -->
@section('content')
    <p>Exec Playbook.</p>
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
                            <td><input readonly type="text" value="<?php echo $playbook['name'] ?>" name="name" class="form-control" style="width:300px;" /></td>
                            <td><input readonly type="text" value="<?php echo $playbook['repository'] ?>" name="repository" class="form-control" style="width:300px;" /></td>
                            <td>
                                <select readonly name="enable_flag" id="model" class="form-control">
                                    <option value="0">有効</option>
                                    <option value="1">無効</option>
                                </select>   
                            </td>
                        </tbody>
                        </table>
                        </div>
                        <label for="textarea1">private_key:</label>
                        <textarea readonly class="form-control" rows="10" name="private_key" class="form-control"><?php echo $playbook['private_key'] ?></textarea>
                        <label for="textarea1">inventory:</label>
                        <textarea readonly class="form-control" rows="10" name="inventory" class="form-control"><?php echo $playbook['inventory'] ?></textarea>
                        <label for="textarea1">vars:</label>
                        <textarea readonly class="form-control" rows="10" name="vars" class="form-control"><?php echo $playbook['vars'] ?></textarea>
                        <label for="textarea1">main:</label>
                        <textarea readonly class="form-control" rows="10" name="main" class="form-control"><?php echo $playbook['main'] ?></textarea>
    <form action="/dryrun_playbook" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id" value="<?php echo $playbook['id'] ?>">
                        <input type="submit" value="ドライラン" class="btn btn-success">
    </form>
    <form action="/run_playbook" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id" value="<?php echo $playbook['id'] ?>">
                        <input type="submit" value="実行" class="btn btn-danger">
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
