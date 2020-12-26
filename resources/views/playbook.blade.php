<html style="zoom: 80%">
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
    <table id="playbookTable" class="table table-striped table-bordered table-sm"　width="100%">
    <thead class="thead-dark">
        <tr>
            <th class="text-nowrap">name</th>
            <th class="text-nowrap">repository</th>
            <th class="text-nowrap">操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach($playbooks as $playbook)
            <tr>
                        <td>{{ optional($playbook)->name }}</td>
                        <td>{{ optional($playbook)->repository }}</td>
                        <td>
                            <form action="/edit" method="POST">
                                @csrf
                                @method('POST')
                                <input title="データを更新" type="submit" value="編集" class="btn btn-success">
                                <input type="hidden" name="id" value="{{ $playbook->id }}">
                            </form>
                        </td>
            </tr>
        @endforeach
    </tbody>

@stop

<!-- 読み込ませるCSSを入力 -->
@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

<!-- 読み込ませるJSを入力 -->
@section('js')
    <script> console.log('Hi!'); </script>
@stop
