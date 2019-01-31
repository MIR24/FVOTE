@extends($layout)

@section('pageTitle')Результат голосования@stop
@section('toolBar')
@stop
@section('content')
<h1>{{ $nomination->name }}</h1>
<h3>{{ $nomination->fillial }}</h3>
@foreach ($nomination->competitiveWorks as $work)
<div class="jumbotron">
    <h4>{{ $work->name }}</h4>
    <h5>{{ $work->filial }}</h5>
    <p>Голосов: {{ $work->count }}</p>
    @if ($work->count > 0) 
    <p>Проголосовали за:<br/>
        @foreach ($work->voters as $voter)
    <li>{{ $voter->name }}</li>
    @endforeach
</p>
@endif
</div>
@endforeach
<div class="jumbotron">
    <h2>Не проголосовали</h2>
    @foreach ($dontVoted as $user)
    <li> {{ $user }} </li>
    @endforeach
</div>
@stop
@push('scripts')

@endpush