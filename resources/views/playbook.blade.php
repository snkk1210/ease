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

@section('title', 'Playbooks')

@section('content_header')
    <h1>Playbooks</h1>
@stop

@section('content')
    <p>This is Playbooks.</p>

    <div class="table-responsive">
        <table id="playbookTable" class="table table-striped table-bordered table-sm" width="100%">
            <thead>
                <tr>
                    <th class="text-nowrap" width="25%">Playbook</th>
                    <th class="text-nowrap" width="25%">Repository</th>
                    <th class="text-nowrap" width="20%">Owner</th>
                    <th class="text-nowrap" width="10%">Archive</th>
                    <th class="text-nowrap" width="10%">Edit</th>
                    <th class="text-nowrap" width="10%">Run</th>
                </tr>
            </thead>
            <tbody>
                @foreach($playbooks as $playbook)
                    <tr>
                        <td>{{ optional($playbook)->playbooks_name }}</td>
                        <td>{{ optional($playbook)->repository }}</td>
                        <td>{{ optional($playbook)->name }}</td>
                        <td>
                            <form action="/disable_playbook" method="POST">
                                @csrf
                                @method('POST')
                                <input title="Archive" type="submit" value="Archive" class="btn btn-warning tablebtn">
                                <input type="hidden" name="id" value="{{ $playbook->playbooks_id }}">
                            </form>
                        </td>
                        <td>
                            <form action="/edit_playbook" method="POST">
                                @csrf
                                @method('POST')
                                <input title="Edit" type="submit" value="Edit" class="btn btn-success tablebtn">
                                <input type="hidden" name="id" value="{{ $playbook->playbooks_id }}">
                            </form>
                        </td>
                        <td>
                            <form action="/exec_playbook" method="POST">
                                @csrf
                                @method('POST')
                                <input title="Run" type="submit" value="Run" class="btn btn-danger tablebtn">
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
    <link rel="stylesheet" href="/css/btn.css">
@stop

@section('js')

@stop
