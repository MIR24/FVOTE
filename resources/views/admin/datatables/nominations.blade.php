@extends($layout)

@section('pageTitle')Номинации@stop
@section('toolBar')
<a href="{{ route('nominations.create') }}" class="btn btn-primary" role="button">Создать</a>
@stop
@section('content')
<table class="table table-bordered" id="nominations-table">
    <thead>
        <tr>
            <th style="width:15px">Id</th>
            <th style="width:5px"></th>
            <th>Название</th>
            <th style="width:200px">Начало</th>
            <th style="width:200px">Окончание</th>
            <th style="width:25px">Голосов</th>
            <th style="width:300px">Действие</th>
        </tr>
    </thead>
</table>
@stop

@push('scripts')
<script src="../assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<script>
$(function () {
    $('#nominations-table').DataTable({
        processing: true,
        serverSide: true,
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
            "zeroRecords": "Ничего не нашел",
            "infoFiltered": "(выбранно из _MAX_ записей)"

        },
        ajax: '{!! route('api.nominations.index') !!}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'status', name: 'status'},
            {data: 'name', name: 'name'},
            {data: 'from_time', name: 'from_time'},
            {data: 'to_time', name: 'to_time'},
            {data: 'votes', name: 'votes', orderable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        lengthMenu: [
            [50, 100, 250, 500],
            [50, 100, 250, 500] // change per page values here
        ],
        columnDefs: [
            {"render": function (data, type, row) {
                    if (data == "active") {
                        return '<span class="badge badge-empty badge-success"></span>';
                    } else {
                        return '<span class="badge badge-empty badge-warning"></span>';
                    }
                }, "targets": 1
            },
            {"render": function (data, type, row) {
                        return '<a href="/nominations/'+data+'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Редактировать</a>' +
                                '<a href="/nominations/'+data+'/works" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Варианты ответов</a>';
                }, "targets": 6
            }

            ]
    });
});
</script>
@endpush