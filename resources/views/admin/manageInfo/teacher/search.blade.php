{{--@extends('layouts.layoutSidebar')--}}
{{--by LYC--}}
{{--@section('sidebar')--}}
    {{--@include('admin.sidebar')--}}
{{--@endsection--}}

{{--@section('content')--}}

    {{--@if(Session::has('successMsg'))--}}
        {{--<div class="alert alert-success alert-dismissible" role="alert">--}}
            {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
            {{--<i class="fa fa-check-circle"></i> {{Session::get('successMsg')}}--}}
        {{--</div>--}}
    {{--@endif--}}
    {{--@if(Session::has('failureMsg'))--}}
        {{--<div class="alert alert-danger alert-dismissible" role="alert">--}}
            {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
            {{--<i class="fa fa-times-circle"></i> {{Session::get('failureMsg')}}--}}
        {{--</div>--}}
    {{--@endif--}}

    {{--头部--}}
    {{--<div class="panel">--}}
        {{--<div class="panel-heading" >--}}
            {{--页面名称--}}
            {{--<h3 class="panel-title">教师信息条件查询</h3>--}}
            {{--<div class="right">--}}
                {{--<a href="{{ url('/admin/manageInfo/teacherCreate') }}"><span class="label label-primary"><i class="fa fa-plus-square"></i>&nbsp;新增教师 </span></a>--}}
            {{--</div>--}}
