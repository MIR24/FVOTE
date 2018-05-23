@extends($layout)

@section('content')
    <div class="col-md-12 text-center">
        <a href="{{ route('nominations.create') }}" class="btn btn-primary" role="button">Создать</a>
    </div>
    <table class="table table-bordered" id="nominations-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Время начала</th>
                <th>Время окончания</th>
                <th>Имя</th>
                <th>Статус</th>
                <th>Всего проголосовало</th>
                <th>Действие</th>
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
$(function() {
    $('#nominations-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('api.nominations.index') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'from_time', name: 'from_time' },
            { data: 'to_time', name: 'to_time' },
            { data: 'name', name: 'name' },
            { data: 'status', name: 'status' },
            { data: 'votes', name: 'votes' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
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