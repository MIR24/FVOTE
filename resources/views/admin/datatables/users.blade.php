@extends($layout)

@section('content')
    <a href="{{ route('register') }}" class="btn btn-primary float-right" role="button">Создать</a>
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Создан</th>
                <th>Обновлен</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Статус</th>
                <th>Филиал</th>
                <th>Заметка</th>
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('api.users.index') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'status', name: 'status' },
            { data: 'filial', name: 'filial' },
            { data: 'note', name: 'note' }
        ]
    });
});
</script>
@endpush