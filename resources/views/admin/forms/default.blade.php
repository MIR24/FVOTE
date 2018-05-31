@extends('admin.layouts.appnew')
@section('pageTitle'){{ $cardHeader }}@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-body">
                        {!! form($form) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
