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
    $('#userTable').DataTable({
      "pageLength": 100,
      "dom": '<"top"i>rt<"bottom"flp><"clear">'
    });
});
</script>

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')
    <p>This is Users.</p>

    <div class="table-responsive">
        <table id="userTable" class="table table-striped table-bordered table-sm" width="100%">
            <thead>
                <tr>
                    <th class="text-nowrap" width="40%">ユーザ</th>
                    <th class="text-nowrap" width="40%">メールアドレス</th>
                    <th class="text-nowrap" width="10%">役割</th>
                    <th class="text-nowrap" width="10%">編集</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ optional($user)->name }}</td>
                        <td>{{ optional($user)->email }}</td>
                        <td>{{ optional($user)->role }}</td>
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

@section('css')

@stop

@section('js')

@stop
