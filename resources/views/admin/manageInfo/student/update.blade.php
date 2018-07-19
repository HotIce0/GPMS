@extends('layouts.layoutSidebar')
{{--By LHW--}}

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">修改学生信息</h3>
        </div>
        <div class="panel-body">
            @include('admin.manageInfo.student._form')
        </div>
    </div>
@stop