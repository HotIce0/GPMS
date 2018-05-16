@extends('layouts.layoutSidebar')
{{--By LHW--}}

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')

    {{--错误验证提示--}}
    {{--@if(count($errors))--}}
        {{--<div class="alert alert-danger">--}}
            {{--<ul>--}}
                {{--@foreach($errors->all() as $error)--}}
                {{--<li>{{ $error }}</li>--}}
                {{--@endforeach--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--@endif--}}

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">新增学生信息填写</h3>
        </div>
        <div class="panel-body">
            @include('admin.manageInfo.student._form')
        </div>
    </div>
@stop