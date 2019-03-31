@extends('layouts.layoutSidebar')
{{--By Xin--}}

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">新增专业信息填写</h3>
        </div>
        <div class="panel-body">
            @include('admin.manageInfo.Major.form')
            {{--相同部分的代码写在form里面--}}
        </div>
    </div>
    </div>
    </div>
@stop