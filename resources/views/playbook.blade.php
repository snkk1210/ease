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
$('#playbookTable').DataTable({
  "pageLength": 100,
  "dom": '<"top"i>rt<"bottom"flp><"clear">'
});
});
</script>

<!-- ページタイトルを入力 -->
@section('title', 'Playbooks')

<!-- ページの見出しを入力 -->
@section('content_header')
    <h1>Playbooks</h1>
@stop

<!-- ページの内容を入力 -->
@section('content')
    <p>This is Playbooks.</p>

    <div class="table-responsive">
    <table id="playbookTable" class="table table-striped table-bordered table-sm" width="100%">
    <thead>
        <tr>
            <th class="text-nowrap" width="25%">playbook</th>
            <th class="text-nowrap" width="25%">repository</th>
            <th class="text-nowrap" width="30%">owner</th>
            <th class="text-nowrap" width="10%">編集</th>
            <th class="text-nowrap" width="10%">実行</th>
        </tr>
    </thead>
    <tbody>
        @foreach($playbooks as $playbook)
            <tr>
                        <td>{{ optional($playbook)->playbooks_name }}</td>
                        <td>{{ optional($playbook)->repository }}</td>
                        <td>{{ optional($playbook)->name }}</td>
                        <td>
                            <form action="/edit_playbook" method="POST">
                                @csrf
                                @method('POST')
                                <input title="編集" type="submit" value="編集" class="btn btn-success">
                                <input type="hidden" name="id" value="{{ $playbook->playbooks_id }}">
                            </form>
                        </td>
                        <td>
                            <form action="/exec_playbook" method="POST">
                                @csrf
                                @method('POST')
                                <input title="実行" type="submit" value="実行" class="btn btn-danger">
                                <input type="hidden" name="id" value="{{ $playbook->playbooks_id }}">
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
