@extends('layouts.layoutSidebar')
{{--by Xin--}}
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
            <h3 class="panel-title">专业信息管理</h3>
            <div class="right">
                <a href="{{ url('admin/manageInfo/majorCreate') }}"><span class="label label-primary"><i class="fa fa-plus-square"></i>&nbsp;新增专业</span></a>
            </div>
            {{--专业编号搜索框--}}
            <div class="col-md-8 col-sm-8 col-lg-8"></div>
            <div class="col-md-4 col-sm-4 col-lg-4"><br>
                <form role="form" class="form-horizontal" method="get" action="{{ url('Major') }}" id="searchMajorNumberForm" >
                    <div class="input-group">
                        <input class="form-control" name="searchMajor" type="text" placeholder="请输入专业编号或名称(空白显示全部)" value="{{$searchMajorNumberForm}}">
                        <span class="input-group-btn"><a onclick="searchMajorNumber()" class="btn btn-primary">搜索</a></span>
                    </div>
                    <script type="text/javascript">
                        function searchMajorNumber() {
                            document.getElementById("searchMajorNumberForm").submit();
                        }
                    </script>
                </form><br>
            </div>
        </div>
        {{--专业按学院分类--}}
        {{--<div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">学院分类
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li>
                    @foreach($collegeInfos as $collegeInfo)
                        <a href="#">{{$collegeInfo->college_name}}</a>
                    @endforeach
                </li>
            </ul>
        </div>--}}
        {{--中间内容，专业信息显示--}}
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>操作管理</th>
                    <th>专业编号</th>
                    <th>专业名称</th>
                    <th>所属学院</th>
                </tr>
                </thead>
                <tbody>
                @foreach($majorInfos as $majorInfo)
                    <tr>
                        <td>
                            <a href="{{ url('/admin/manageInfo/majorUpdate',['id' => $majorInfo->major_info_id])}}">修改</a>
                            <a href="{{ url('/admin/manageInfo/majorDelete',['id' => $majorInfo->major_info_id])}}"
                               onclick="if (confirm('确定要删除吗？') == false) return false;">删除</a>
                        </td>
                        <th>{{ $majorInfo->major_identifier}}</th>
                        {{--专业编号--}}
                        <th>{{ $majorInfo->major_name}}</th>
                        {{--专业名称--}}
                        <th>{{ $majorInfo->getCollegeInfo["college_name"]}}</th>
                        {{--所属学院--}}
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
    {{--分页--}}
    <div class="pull-right">
        {{ $majorInfos->render() }}
    </div>
    </div>
@stop