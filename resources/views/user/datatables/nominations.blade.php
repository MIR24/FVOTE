@extends('admin.layouts.app')

@section('content')
    <style>.hand {  cursor: pointer; }</style>
    <table class="table table-bordered" id="nominations-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Время начала</th>
                <th>Время окончания</th>
                <th>Имя</th>
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script>
$(function() {
    $('#nominations-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('api.nominations.index') !!}',
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
        columns: [
            { data: 'id', name: 'id', className: 'hand' },
            { data: 'from_time', name: 'from_time' , className: 'hand'},
            { data: 'to_time', name: 'to_time' , className: 'hand'},
            { data: 'name', name: 'name' , className: 'hand'}
        ],
        fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            // Row click
            $(nRow).on('click', function() {
                window.location.href = window.location.href+'/'+aData.id+'/works';
            });
        }
    });
});
</script>
@endpush