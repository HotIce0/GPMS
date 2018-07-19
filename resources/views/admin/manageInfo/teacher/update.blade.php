@extends('layouts.layoutSidebar')
{{--By LYC--}}

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">修改教师信息填写</h3>
        </div>
        <div class="panel-body">
            @include('admin.manageInfo.teacher.form')
        </div>
    </div>
@endsection