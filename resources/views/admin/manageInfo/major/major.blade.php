@extends('layouts.layoutSidebar')
{{--by LHW--}}
@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')

    {{--添加提示响应--}}
    <!-- ERROR TIP -->
    @if(Session::has('successMsg'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-check-circle"></i>{{ Session::get('successMsg') }}
        </div>
    @endif
    @if(Session::has('failureMsg'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-times-circle"></i>{{ Session::get('failureMsg') }}
        </div>
    @endif
    <!-- END ERROR TIP -->


    {{--自定义内容--}}
    <div class="panel">
        <div class="panel-heading" >
            <h3 class="panel-title">专业信息管理</h3>
            <div class="right">
                <a href="{{ url('admin/manageInfo/majorCreate') }}"><span class="label label-primary"><i class="fa fa-plus-square"></i>&nbsp;新增专业</span></a>
            </div>
        </div>
        {{--专业编号搜索框--}}
        <div class="col-md-4 col-sm-4 col-lg-4">
            <form role="form" class="form-horizontal" method="get" action="{{url('admin/manageInfo/Major')}}" id="searchMajorNumberForm">
                <div class="input-group">
                    <input class="form-control" name="major_identifier" type="text" placeholder="请输入专业编号" value="{{ $searchMajorNumberForm }}">
                    <span class="input-group-btn"><a onclick="searchMajorNumber()" class="btn btn-primary">搜索</a></span>
                </div>
                <script type="text/javascript">
                    function searchMajorNumber() {
                        document.getElementById("searchMajorNumberForm").submit();
                    }
                </script>
            </form><br>
        </div>

        {{--专业名称搜索框--}}
        <div class="col-md-4 col-sm-4 col-lg-4">
            <form role="form" class="form-horizontal" method="get" action="{{url('admin/manageInfo/Major')}}" id="searchMajorNameForm">
                <div class="input-group">
                    <input class="form-control" name="major_name" type="text" placeholder="请输入专业名称" value="{{ $searchMajorNameForm }}">
                    <span class="input-group-btn"><a onclick="searchMajorName()" class="btn btn-primary">搜索</a></span>
                </div>
                <script type="text/javascript">
                    function searchMajorName() {
                        document.getElementById("searchMajorNameForm").submit();
                    }
                </script>
            </form><br>
        </div>

        {{--所属学院搜索框--}}
        <div class="col-md-4 col-sm-4 col-lg-4">
            <form role="form" class="form-horizontal" method="get" action="{{url('admin/manageInfo/Major')}}" id="searchMajorCollegeForm">
                <div class="input-group">
                    {{--<input class="form-control" name="college_info_id" type="text" placeholder="所属学院">--}}
                    <select class="form-control" name="college_info_id">
                        <option value="">所属学院</option>
                        @foreach($date1 as $college)
                            <option value="{{$college->college_info_id}}"{{ $college->college_info_id == $searchMajorCollegeForm ? 'selected' : '' }}>
                                {{$college->college_name}}
                            </option>
                        @endforeach
                    </select>
                    <span class="input-group-btn"><a onclick="searchMajorCollege()" class="btn btn-primary">搜索</a></span>
                </div>
                <script type="text/javascript">
                    function searchMajorCollege() {
                        document.getElementById("searchMajorCollegeForm").submit();
                    }
                </script>
            </form><br>
        </div>

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
                @foreach($majorInfos->sortBy('major_identifier') as $majorInfo)
                    <tr>
                        <td>
                            <a href="{{ url('admin/manageInfo/majorDetail',['id'=>$majorInfo->major_info_id] )}}">详情</a>
                            <a href="{{ url('admin/manageInfo/majorUpdate',['id'=>$majorInfo->major_info_id] )}}">修改</a>
                            <a href="{{ url('admin/manageInfo/majorDelete',['id'=>$majorInfo->major_info_id] )}}"
                               onclick="if (confirm('确定要删除这条专业信息吗？') == false) return false;">删除</a>
                        </td>
                        <th>{{$majorInfo->major_identifier}}</th>
                        {{--专业编号--}}
                        <th>{{$majorInfo->major_name}}</th>
                        {{--专业名称--}}
                        <th>{{$majorInfo->college_info_id($majorInfo->college_info_id)}}</th>
                        {{--所属学院--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-heading" >
            <div class="right">
                <a href="{{ url('admin/manageInfo/majorRecyclePage') }}"><span class="label label-primary"><i class="fa fa-recycle"></i>&nbsp;回收专业</span></a>
            </div>
        </div>
    </div>


    {{--分页--}}
    <div>
        <div class="pull-left">
            {{ $majorInfos->render() }}
        </div>
    </div>
@stop