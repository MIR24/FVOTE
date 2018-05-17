@extends('layouts.app')

@section('content')
    <table class="table table-bordered" id="nominations-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Имя</th>
                <th>Статус</th>
                <th>Время начала</th>
                <th>Время окончания</th>
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
            { data: 'name', name: 'name' },
            { data: 'status', name: 'status' },
            { data: 'from_time', name: 'from_time' },
            { data: 'to_time', name: 'to_time' }
        ]
    });
});
</script>
@endpush