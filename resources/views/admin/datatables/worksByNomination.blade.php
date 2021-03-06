@extends($layout)

@section('toolBar')
<a href="{{ route('works.create').'/'.$model->id }}" class="btn btn-primary" role="button">Добавить вариант ответа</a>
@stop
@section('content')
<table class="table table-bordered" id="works-by-nomination-table">
    <thead>
        <tr>
            <th>Месяц: Название сюжета</th>
            <th>Ссылка</th>
            <th>Филиал</th>
            <th>Корреспондент</th>
            <th>Оператор</th>
            <th>Голоса</th>
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
    $('#works-by-nomination-table').DataTable({
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
            "zeroRecords": "Ничего не нашел"

        },
        lengthMenu: [
            [50, 100, 250, 500],
            [50, 100, 250, 500] // change per page values here
        ],
        "iDisplayLength": 100,
        ajax: '{!! route('api.works.indexByNomination', ['id' => $model->id]) !!}',
        columns: [
            {data: 'name', name: 'name'},
            {data: 'url', name: 'url'},
            {data: 'filial', name: 'filial'},
            {data: 'correspondent', name: 'correspondent'},
            {data: 'operator', name: 'operator'},
            {data: 'votes', name: 'votes', orderable: false, searchable: false},
            {data: 'edit', name: 'edit', orderable: false, searchable: false}
        ]
    });
});
</script>
@endpush
