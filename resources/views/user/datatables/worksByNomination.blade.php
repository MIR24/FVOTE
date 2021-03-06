@extends($layout)

@section('content')
    <table class="table table-bordered" id="works-by-nomination-table">
        <thead>
            <tr>
                <th>Месяц: Название сюжета</th>
                <th>Ссылка</th>
                <th>Филиал</th>
                <th>Корреспондент</th>
                <th>Оператор</th>
                @if ($model->status == 'active')
                <th>Голосование</th>
                @endif
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script>
$(function() {
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
            "zeroRecords": "Ничего не нашел",
            "infoFiltered": "(выбранно из _MAX_ записей)"

        },
        lengthMenu: [
            [50, 100, 250, 500],
            [50, 100, 250, 500] // change per page values here
        ],
        "iDisplayLength": 100,
        ajax: '{!! route('api.works.indexByNomination', ['id' => $model->id]) !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'url', name: 'url' },
            { data: 'filial', name: 'filial' },
            { data: 'correspondent', name: 'correspondent' },
            { data: 'operator', name: 'operator' } @if ($model->status == 'active'),
            { data: 'action', name: 'action', orderable: false, searchable: false } @endif
        ]
    });
});
</script>
@endpush