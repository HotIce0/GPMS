@extends('layouts.layoutSidebar')
{{--By xiaoming--}}

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">修改学院信息填写</h3>
        </div>
        <div class="panel-body">
            @include('admin.manageInfo.college.form')
            {{--相同部分的代码写在form里面--}}
        </div>
    </div>
@endsection