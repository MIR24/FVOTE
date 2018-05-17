@extends('layouts.app')

@section('content')
    <table class="table table-bordered" id="works-by-nomination-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Филиал представительств</th>
                <th>Название сюжета</th>
                <th>Ссылка на сюжет</th>
                <th>Корреспондент</th>
                <th>Оператор</th>
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
        ajax: '{!! route('apiWorksIndexByNomination', ['id' => $id]) !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'filial', name: 'filial' },
            { data: 'name', name: 'name' },
            { data: 'url', name: 'url' },
            { data: 'correspondent', name: 'correspondent' },
            { data: 'operator', name: 'operator' }
        ]
    });
});
</script>
@endpush