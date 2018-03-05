@extends('layouts.layoutSidebar')
{{--by xiaoming--}}
@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')

    <!-- ERROR TIP -->
    @if(Session::has('successMsg'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-check-circle"></i> {{Session::get('successMsg')}}
        </div>
    @endif
    @if(Session::has('failureMsg'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-times-circle"></i> {{Session::get('failureMsg')}}
        </div>
    @endif
    <!-- END ERROR TIP -->

    {{--头部--}}
<div class="panel">
    <div class="panel-heading" >
        {{--页面名称--}}
        <h3 class="panel-title">班级信息管理</h3>
        <div class="right">
            <a href="{{ url('/admin/manageInfo/classCreate') }}"><span class="label label-primary"><i class="fa fa-plus-square"></i>&nbsp;新增班级</span></a>
        </div>

        {{--班级编号搜索框--}}
        <div class="col-md-8 col-sm-8 col-lg-8"></div>
        <div class="col-md-4 col-sm-4 col-lg-4"><br>
            <form role="form" class="form-horizontal" method="get" action="{{ url('admin/manageInfo/class') }}" id="searchClassNumberForm" >
                <div class="input-group">
                    <input class="form-control" name="searchClass" type="text" placeholder="请输入班级编号或名称" value="{{$searchClassNumberForm}}">
                    <span class="input-group-btn"><a onclick="searchClassNumber()" class="btn btn-primary">搜索</a></span>
                </div>
                <script type="text/javascript">
                    function searchClassNumber() {
                        document.getElementById("searchClassNumberForm").submit();
                    }
                </script>
            </form><br>
        </div>
    </div>

    {{--中间内容，班级信息显示--}}
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
             <tr>
                <th>操作管理</th>
                <th>班级编号</th>
                <th>班级名称</th>
                <th>所属学院</th>
            </tr>
            </thead>
            <tbody>
                @foreach($classInfos as $classInfo)
                <tr>
                    <td>
                        <a href="{{ url('/admin/manageInfo/classUpdate',['id' => $classInfo->class_info_id])}}">修改</a>
                        <a href="{{ url('/admin/manageInfo/classDelete',['id' => $classInfo->class_info_id])}}"
                           onclick="if (confirm('确定要删除吗？') == false) return false;">删除</a>
                    </td>
                    {{--班级编号--}}
                    <th>{{ $classInfo->class_identifier}}</th>
                    {{--班级名称--}}
                    <th>{{ $classInfo->class_name}}</th>
                    {{--所属学院--}}
                    <th>{{ $classInfo->getCollegeInfo["college_name"]}}</th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    {{--<div class="panel-footer">--}}
        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div>--}}
                    {{--<label for="待写" class="col-sm-2 control-label">当前显示学院：</label>--}}
                {{--</div>--}}
                {{--<div class="col-md-2">--}}
                    {{--<form class="form-inline" id="pageNumForm" role="form" method="get" action="{{url('createProject/ManageProjects')}}">--}}
                        {{--{{csrf_field()}}--}}
                        {{--<div class="form-group">--}}
                            {{--<select title="当前显示学院" id="selectPages" name="selectPages" class="form-control field">--}}
                                {{--<option value="1" id="1">计算机学院</option>--}}
                                {{--<option value="2" id="2">数学学院</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
                {{--<div>--}}
                    {{--<label for="待写" class="col-sm-2 control-label">当前显示年级：</label>--}}
                {{--</div>--}}
                {{--<div class="col-md-2">--}}
                    {{--<form class="form-inline" id="pageNumForm" role="form" method="get" action="{{url('createProject/ManageProjects')}}">--}}
                        {{--{{csrf_field()}}--}}
                        {{--<div class="form-group">--}}
                            {{--<select title="当前显示年级" id="selectPages" name="selectPages" class="form-control field">--}}
                                {{--<option value="16" id="16">16级</option>--}}
                                {{--<option value="15" id="15">15级</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
</div>
@stop
