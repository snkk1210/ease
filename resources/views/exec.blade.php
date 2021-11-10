@extends('adminlte::page')

@section('title', 'Exec Playbook')

@section('content_header')
    <h1>Exec Playbook</h1>
@stop

@section('content')
    <p>Exec Playbook.</p>

    <div class="table-responsive">
        <table id="matterTable" class="table table-striped table-bordered table-sm">
            <thead class="thead-dark">
                <tr>
                    <th class="text-nowrap">Playbook</th>
                    <th class="text-nowrap">Repository</th>
                    <th class="text-nowrap">Auth</th>
                </tr>
            </thead>
            <tbody>
                <td><input readonly type="text" value="<?php echo $playbook['name'] ?>" name="name" class="form-control" style="width:300px;" /></td>
                <td><input readonly type="text" value="<?php echo $playbook['repository'] ?>" name="repository" class="form-control" style="width:300px;" /></td>
                <td>
                    @foreach($authes as $index => $name)
                        @if ($name->id == $playbook['auth_id'])
                            <input readonly type="text" value="<?php echo $name->auth_name ?>" name="repository" class="form-control" style="width:300px;" />
                        @else
                        @endif
                    @endforeach
                </td>
            </tbody>
        </table>
    </div>
    <label for="textarea1">private_key :</label>
    <textarea readonly class="form-control" rows="10" name="private_key" class="form-control"><?php echo $playbook['private_key'] ?></textarea>
    <label for="textarea1">inventory :</label>
    <textarea readonly class="form-control" rows="10" name="inventory" class="form-control"><?php echo $playbook['inventory'] ?></textarea>
    <label for="textarea1">vars :</label>
    <textarea readonly class="form-control" rows="10" name="vars" class="form-control"><?php echo $playbook['vars'] ?></textarea>
    <label for="textarea1">main :</label>
    <textarea readonly class="form-control" rows="10" name="main" class="form-control"><?php echo $playbook['main'] ?></textarea>
 
    <div id="Loading" style="display:none;">
        <p class="loadmsg">in process... <i id="icon" class="fas fa-sync fa-spin"></i></p>
    </div>
 
    <select name="dryrun_auth" id="dryrunmodel" class="form-control" onchange="changeDryrunAction()">
        <option value="1">Public Key authentication</option>
        <option value="2">Password authentication</option>
    </select>

    <form id="dryrunformId" action="/dryrun_playbook" method="POST">
        @csrf
        @method('POST')
        <input type="hidden" name="id" value="<?php echo $playbook['id'] ?>">
        <input type="submit" value="DryRun" class="btn btn-success opbtn" onclick="Form_Submit()">
    </form>

    <select name="run_auth" id="runmodel" class="form-control" onchange="changeRunAction()">
                <option value="1">Public Key authentication</option>
                <option value="2">Password authentication</option>
    </select>

    <form id="runformId" action="/run_playbook" method="POST">
        @csrf
        @method('POST')
        <input type="hidden" name="id" value="<?php echo $playbook['id'] ?>">
        <input type="submit" value="Run" class="btn btn-danger opbtn" onclick="Form_Submit()">
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/make.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/btn.css">
@stop

@section('js')
    <script>
    document.getElementById("icon").style.display ="none";
    /*実行ボタン押下時の関数*/
    function Form_Submit(){
        document.getElementById("Loading").style.display = "block";  
        document.getElementById("icon").style.display ="";
        document.getElementById("Loading").style.top = 150
        document.getElementById("Loading").style.left = (document.body.clientWidth - 300) / 2;
    }
    /*dryrun時の認証方法選択関数*/
    function changeDryrunAction() {
            var model = document.getElementById("dryrunmodel").value;
            var status = "";
            if (model < 2){
                status = "/dryrun_playbook";
            } else {
                status = "/dryrunpass_playbook";
            }
            
            var formObject = document.getElementById('dryrunformId');
            formObject.action = status;
        }
    /*run時の認証方法選択関数*/
    function changeRunAction() {
            var model = document.getElementById("runmodel").value;
            var status = "";
            if (model < 2){
                status = "/run_playbook";
            } else {
                status = "/runpass_playbook";
            }
            
            var formObject = document.getElementById('runformId');
            formObject.action = status;
        }
    </script>
@stop
