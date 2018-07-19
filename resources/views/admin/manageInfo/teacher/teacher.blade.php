@extends('layouts.layoutSidebar')
{{--by LYC--}}
@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')

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
            <h3 class="panel-title">教师信息管理</h3>
            <div class="right">
                <a href="{{ url('/admin/manageInfo/teacherCreate') }}"><span class="label label-primary"><i class="fa fa-plus-square"></i>&nbsp;新增教师 </span></a>
            </div>

            {{--教师工号搜索框--}}
            <div class="col-md-8 col-sm-8 col-lg-8"></div>
            <div class="col-md-4 col-sm-4 col-lg-4"><br>
                <form role="form" class="form-horizontal" method="get" action="{{ url('admin/manageInfo/teacher') }}" id="searchTeacherNumberForm" >
                    <div class="input-group">
                        <input class="form-control" name="searchTeacher" type="text" placeholder="请输入教师工号" value="{{$searchTeacherNumberForm}}">
                        <span class="input-group-btn"><a onclick="searchTeacherNumber()" class="btn btn-primary">搜索</a></span>
                    </div>
                    <script type="text/javascript">
                        function searchTeacherNumber() {
                            document.getElementById("searchTeacherNumberForm").submit();
                        }
                    </script>
                </form><br>
            </div>
        </div>

        {{--中间内容，教师信息显示--}}
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>操作管理</th>
                    <th>教师工号</th>
                    <th>教师名称</th>
                    <th>所属学院</th>
                    <th>所属教研室<th>
                    {{--<th>邮箱地址<th>--}}
                    {{--<th>电话号码<th>--}}
                    {{--<th>职称<th>--}}
                    {{--<th>QQ号<th>--}}
                    {{--<th>微信号<th>--}}
                    {{--<th>可指导最大学生数<th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($teacherInfos as $teacherInfo)
                    <tr>
                        <td>
                            <a href="{{ url('/admin/manageInfo/teacherDetail',['id' => $teacherInfo->teacher_info_id])}}">详情</a>
                            <a href="{{ url('/admin/manageInfo/teacherUpdate',['id' => $teacherInfo->teacher_info_id])}}">修改</a>
                            <a href="{{ url('/admin/manageInfo/teacherDelete',['id' => $teacherInfo->teacher_info_id])}}"
                               onclick="if (confirm('确定要删除吗？') == false) return false;">删除</a>
                        </td>
                        {{--教师工号--}}
                        <th>{{ $teacherInfo->teacher_job_number }}</th>
                        {{--教师名称--}}
                        <th>{{ $teacherInfo->teacher_name }}</th>
                        {{--所属学院--}}
                        <th>{{ $teacherInfo->getCollegeInfo["college_name"] }}</th>
                        {{--所属教研室--}}
                        <th>{{ $teacherInfo->getSectionInfo['section_name'] }}<th>
                        {{--邮箱地址--}}
                        {{--<th>{{ $teacherInfo->mail_address }}<th>--}}
                        {{--电话号码--}}
                        {{--<th>{{ $teacherInfo->phone_number }}<th>--}}
                        {{--职称--}}
                        {{--<th>{{ $teacherInfo->positional_title }}<th>--}}
                        {{--QQ号--}}
                        {{--<th>{{ $teacherInfo->qq_number  }}<th>--}}
                        {{--微信号--}}
                        {{--<th>{{ $teacherInfo->wechart_name }}<th>--}}
                        {{--可指导最大学生数--}}
                        {{--<th>{{ $teacherInfo->max_students }}<th>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
            <div class="pull-left">
                {{ $teacherInfos->render() }}
            </div>
    </div>
@stop