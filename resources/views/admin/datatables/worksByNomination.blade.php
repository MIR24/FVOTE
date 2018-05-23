@extends($layout)

@section('content')
    <div class="col-md-12 text-center">
        <a href="{{ route('works.create') }}" class="btn btn-primary" role="button">Создать</a>
    </div>
    <table class="table table-bordered" id="works-by-nomination-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Филиал представительств</th>
                <th>Название сюжета</th>
                <th>Ссылка на сюжет</th>
                <th>Корреспондент</th>
                <th>Оператор</th>
                <th>Голоса</th>
                <th>Действие</th>
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
$(function() {
    $('#works-by-nomination-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('api.works.indexByNomination', ['id' => $model->id]) !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'filial', name: 'filial' },
            { data: 'name', name: 'name' },
            { data: 'url', name: 'url' },
            { data: 'correspondent', name: 'correspondent' },
            { data: 'operator', name: 'operator' },
            { data: 'votes', name: 'votes', orderable: false, searchable: false },
            { data: 'edit', name: 'edit', orderable: false, searchable: false }
        ]
    });
});
</script>
@endpush