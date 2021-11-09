@extends('adminlte::page')

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

@section('title', 'Archives')

@section('content_header')
    <h1>Archives</h1>
@stop

@section('content')
    <p>This is Archives.</p>

    <div class="table-responsive">
        <table id="playbookTable" class="table table-striped table-bordered table-sm" width="100%">
            <thead>
                <tr>
                    <th class="text-nowrap" width="25%">playbook</th>
                    <th class="text-nowrap" width="25%">repository</th>
                    <th class="text-nowrap" width="20%">owner</th>
                    <th class="text-nowrap" width="16%">アーカイブ</th>
                    <th class="text-nowrap" width="15%">削除</th>
                </tr>
            </thead>
            <tbody>
                @foreach($playbooks as $playbook)
                    <tr>
                        <td>{{ optional($playbook)->playbooks_name }}</td>
                        <td>{{ optional($playbook)->repository }}</td>
                        <td>{{ optional($playbook)->name }}</td>
                        <td>
                            <form action="/enable_playbook" method="POST">
                                @csrf
                                @method('POST')
                                <input title="元に戻す" type="submit" value="元に戻す" class="btn btn-warning">
                                <input type="hidden" name="id" value="{{ $playbook->playbooks_id }}">
                            </form>
                        </td>
                        <td>
                            <form action="/remove_playbook" method="POST">
                                @csrf
                                @method('POST')
                                <input title="削除" type="submit" value="削除" class="btn btn-danger" onClick="delete_alert(event);return false;">
                                <input type="hidden" name="id" value="{{ $playbook->playbooks_id }}">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop

@section('css')

@stop

@section('js')
    <script src="js/alert.js"></script>
@stop
