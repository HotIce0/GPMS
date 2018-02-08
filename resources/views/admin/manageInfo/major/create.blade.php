@extends('layouts.layoutSidebar')
{{--By LHW--}}

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">新增专业信息填写</h3>
        </div>
        <div class="panel-body">
            @include('admin.manageInfo.major.form')
        </div>
    </div>
@stop