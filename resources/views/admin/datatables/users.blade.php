@extends($layout)
@section('pageTitle')Пользователи@stop
@section('toolBar')
<a href="{{ route('register') }}" class="btn btn-primary" role="button">Создать</a>
@stop
@section('content')
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
            <th>Действие</th>
        </tr>
    </thead>
</table>
@stop

@push('scripts')
<script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script>
$(function () {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('api.users.index') !!}',
        language: {
            // metronic spesific
            "metronicGroupActions": " _TOTAL_ номинаций ",
            "metronicAjaxRequestGeneralError": "Не могу получить данные, проверьте связь с интернет",
            // data tables spesific
            "lengthMenu": "На странице _MENU_ ",
            "search": "Отфильтровать: ",
            "info": "Всего _TOTAL_ номинаций",
            "infoEmpty": "Нечего показать",
            "emptyTable": "Ничего не нашел",
            "zeroRecords": "Ничего не нашел"

        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'status', name: 'status'},
            {data: 'filial', name: 'filial'},
            {data: 'note', name: 'note'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endpush