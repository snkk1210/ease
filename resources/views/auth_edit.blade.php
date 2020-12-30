@extends('adminlte::page')

<!-- ページタイトルを入力 -->
@section('title', 'Edit Authentication')

<!-- ページの見出しを入力 -->
@section('content_header')
    <h1>Edit Authentication</h1>
@stop

<!-- ページの内容を入力 -->
@section('content')
    <p>Edit Authentication.</p>

    <form action="/update_auth" method="POST">
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
                            <td><input type="text" value="<?php echo $edit_auth['auth_name'] ?>" name="auth_name" class="form-control" style="width:300px;" /></td>
                            <td><input type="text" value="<?php echo $edit_auth['ssh_pass'] ?>" name="ssh_pass" class="form-control" style="width:300px;" /></td>
                        </tbody>
                        </table>
                        </div>
                        <label for="textarea1">private_key:</label>
                        <textarea class="form-control" rows="10" name="ssh_key" class="form-control"><?php echo $edit_auth['ssh_key'] ?></textarea>
                        <input type="hidden" name="id" value="<?php echo $edit_auth['id'] ?>">
                        <input type="submit" value="更新" class="btn btn-success">
    </form>
    <form action="/remove_auth" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id" value="<?php echo $edit_auth['id'] ?>">
                        <input type="submit" value="削除" class="btn btn-danger" onClick="delete_alert(event);return false;">
    </form>
@stop

<!-- 読み込ませるCSSを入力 -->
@section('css')
    <link rel="stylesheet" href="/css/make.css">
@stop

<!-- 読み込ませるJSを入力 -->
@section('js')
<script>
function delete_alert(e){
   if(!window.confirm('本当に削除しますか？')){
      window.alert('キャンセルされました'); 
      return false;
   }
   document.deleteform.submit();
};
</script>
@stop
