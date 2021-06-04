<!-- <html style="zoom: 80%"> -->
@extends('adminlte::page')

{{-- Datatable読み込み用 --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
jQuery(function($){
$.extend( $.fn.dataTable.defaults, {
language: {
url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
}
});
$('#userTable').DataTable({
  "pageLength": 100,
  "dom": '<"top"i>rt<"bottom"flp><"clear">'
});
});
</script>

<!-- ページタイトルを入力 -->
@section('title', 'Users')

<!-- ページの見出しを入力 -->
@section('content_header')
    <h1>Users</h1>
@stop

<!-- ページの内容を入力 -->
@section('content')
    <p>This is Users.</p>

    <div class="table-responsive">
    <table id="userTable" class="table table-striped table-bordered table-sm" width="100%">
    <thead>
        <tr>
            <th class="text-nowrap" width="40%">ユーザ</th>
            <th class="text-nowrap" width="40%">メールアドレス</th>
            <th class="text-nowrap" width="10%">役割</th>
            <!-- # TODO: ユーザの有効/無効機能を追加予定
            <th class="text-nowrap" width="10%">有効/無効</th>
            -->
            <th class="text-nowrap" width="10%">編集</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                        <td>{{ optional($user)->name }}</td>
                        <td>{{ optional($user)->email }}</td>
                        <td>{{ optional($user)->role }}</td>
                        <!-- # TODO: ユーザの有効/無効機能を追加予定
                        <td>
                            <form action="/switch_user" method="POST">
                                @csrf
                                @method('POST')
                                <input title="無効" type="submit" value="無効" class="btn btn-warning">
                                <input type="hidden" name="id" value="{{ $user->id }}">
                            </form>
                        </td>
                        -->
                        <td>
                            <form action="/edit_user" method="POST">
                                @csrf
                                @method('POST')
                                <input title="編集" type="submit" value="編集" class="btn btn-success">
                                <input type="hidden" name="id" value="{{ $user->id }}">
                            </form>
                        </td>
            </tr>
        @endforeach
    </tbody>
    </table>
    </div>

@stop

<!-- 読み込ませるCSSを入力 -->
@section('css')

<!--    <link rel="stylesheet" href="/css/app.css"> -->

@stop

<!-- 読み込ませるJSを入力 -->
@section('js')
    <script> console.log('Hi!'); </script>
@stop
