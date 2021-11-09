@extends('adminlte::page')

@section('title', 'Make Playbook')

@section('content_header')
    <h1>Make Playbook</h1>
@stop

@section('content')
    <p>Make Playbook.</p>

    <form action="/register_playbook" method="POST">
        @csrf
        @method('POST')
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-nowrap">Playbook名</th>
                        <th class="text-nowrap">リポジトリ</th>
                        <th class="text-nowrap">認証</th>
                    </tr>
                </thead>
                <tbody>
                    <td><input type="text" name="name" class="form-control" style="width:300px;" /></td>
                    <td>
                        <select name="repository" id="model" class="form-control">
                            @foreach($repolists as $index => $repolist)
                                <option value="{{ $repolist }}"><?php echo $repolist ?></option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="auth_id" id="model" class="form-control">
                            @foreach($authes as $index => $name)
                                <option value="{{ $name->id }}"><?php echo $name->auth_name ?></option>
                            @endforeach
                        </select>
                    </td>
                </tbody>
            </table>
        </div>
        <label for="textarea1">private_key:</label>
        <textarea class="form-control" rows="10" name="private_key" class="form-control"></textarea>
        <label for="textarea1">inventory:</label>
        <textarea class="form-control" rows="10" name="inventory" class="form-control"></textarea>
        <label for="textarea1">vars:</label>
        <textarea class="form-control" rows="10" name="vars" class="form-control" id="var-editor"></textarea>
        <label for="textarea1">main:</label>
        <textarea class="form-control" rows="10" name="main" class="form-control" id="txt-editor"></textarea>
        <input type="hidden" name="owner_id" value="{{ $owner_id }}">
        <input type="submit" value="作成" class="btn btn-success">
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="lib/codemirror.css">
    <link rel="stylesheet" href="/css/make.css">
@stop

@section('js')
    <script src="lib/codemirror.js"></script>
    <script src="mode/javascript/javascript.js"></script>
    <script type="text/javascript" src="js/textarea.js"></script>
@stop
