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

@section('title', 'Authentications')

@section('content_header')
    <h1>Authentications</h1>
@stop

@section('content')
    <p>This is Authentications.</p>

    <div class="table-responsive">
        <table id="playbookTable" class="table table-striped table-bordered table-sm" width="100%">
            <thead>
                <tr>
                    <th class="text-nowrap" width="25%">認証名</th>
                    <th class="text-nowrap" width="30%">Owner</th>
                    <th class="text-nowrap" width="10%">編集</th>
                </tr>
            </thead>
            <tbody>
                @foreach($auths as $auth)
                    <tr>
                        <td>{{ optional($auth)->auth_name }}</td>
                        <td>{{ optional($auth)->name }}</td>
                        <td>
                            <form action="/edit_auth" method="POST">
                                @csrf
                                @method('POST')
                                <input title="編集" type="submit" value="編集" class="btn btn-success">
                                <input type="hidden" name="id" value="{{ $auth->authentications_id }}">
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

@stop
