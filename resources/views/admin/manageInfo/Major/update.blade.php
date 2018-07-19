@extends('layouts.layoutSidebar')
{{--By Xin--}}

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">修改专业信息填写</h3>
        </div>
        <div class="panel-body">
            @include('admin.manageInfo.Major.form')
            {{--相同部分的代码写在form里面--}}
        </div>
    </div>
@endsection