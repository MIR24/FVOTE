@extends($layout)

@section('content')
    <a href="{{ route('nominationsCreate') }}" class="btn btn-primary float-right" role="button">Создать</a>
    <table class="table table-bordered" id="nominations-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Время начала</th>
                <th>Время окончания</th>
                <th>Имя</th>
                <th>Статус</th>
                <th>Всего проголосовало</th>
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
        ajax: '{!! route('apiNominationsIndex') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'from_time', name: 'from_time' },
            { data: 'to_time', name: 'to_time' },
            { data: 'name', name: 'name' },
            { data: 'status', name: 'status' },
            { data: 'votes', name: 'votes' }
        ]
    });
});
</script>
@endpush