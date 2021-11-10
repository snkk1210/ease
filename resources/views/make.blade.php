@extends('adminlte::page')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                        <th class="text-nowrap">Playbook</th>
                        <th class="text-nowrap">Repository</th>
                        <th class="text-nowrap">Auth</th>
                    </tr>
                </thead>
                <tbody>
                    <td><input type="text" name="name" class="form-control" style="width:300px;" /></td>
                    <td>
                        <select name="repository" id="model" class="form-control select2">
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
        <label for="textarea1">private_key :</label>
        <textarea class="form-control" rows="10" name="private_key" class="form-control"></textarea>
        <label for="textarea1">inventory :</label>
        <textarea class="form-control" rows="10" name="inventory" class="form-control"></textarea>
        <label for="textarea1">vars :</label>
        <textarea class="form-control" rows="10" name="vars" class="form-control" id="var-editor"></textarea>
        <label for="textarea1">main :</label>
        <textarea class="form-control" rows="10" name="main" class="form-control" id="txt-editor"></textarea>
        <input type="hidden" name="owner_id" value="{{ $owner_id }}">
        <input type="submit" value="作成" class="btn btn-success opbtn">
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="lib/codemirror.css">
    <link rel="stylesheet" href="/css/make.css">
    <link rel="stylesheet" href="/css/btn.css">
@stop

@section('js')
    <script src="lib/codemirror.js"></script>
    <script src="mode/javascript/javascript.js"></script>
    <script type="text/javascript" src="js/textarea.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="/js/select2.js"></script>
@stop
