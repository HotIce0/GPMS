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
            <h3 class="panel-title">教师信息管理</h3>
            <div class="right">
                <a href="{{ url('admin/manageInfo/teacherCreate') }}"><span class="label label-primary"><i class="fa fa-plus-square"></i>&nbsp;新增教师</span></a>
            </div>
        </div>
        {{--学生学号搜索框--}}
        <div class="col-md-4 col-sm-4 col-lg-3">
            <form role="form" class="form-horizontal" method="get" action="{{url('admin/manageInfo/Teacher')}}" id="searchTeacherNumberForm">
                <div class="input-group">
                    <input class="form-control" name="teacher_job_number" type="text" placeholder="请输入教师工号">
                    <span class="input-group-btn"><a onclick="searchTeacherNumber()" class="btn btn-primary">搜索</a></span>
                </div>
                <script type="text/javascript">
                    function searchTeacherNumber() {
                        document.getElementById("searchTeacherNumberForm").submit();
                    }
                </script>
            </form>
        </div>

        {{--教师姓名搜索框--}}
        <div class="col-md-4 col-sm-4 col-lg-3">
            <form role="form" class="form-horizontal" method="get" action="{{url('admin/manageInfo/Teacher')}}" id="searchTeacherNameForm">
                <div class="input-group">
                    <input class="form-control" name="teacher_name" type="text" placeholder="请输入教师姓名">
                    <span class="input-group-btn"><a onclick="searchTeacherName()" class="btn btn-primary">搜索</a></span>
                </div>
                <script type="text/javascript">
                    function searchTeacherName() {
                        document.getElementById("searchTeacherNameForm").submit();
                    }
                </script>
            </form>
        </div>

        {{--所属学院搜索框--}}
        <div class="col-md-4 col-sm-4 col-lg-3">
            <form role="form" class="form-horizontal" method="get" action="{{url('admin/manageInfo/Teacher')}}" id="searchTeacherCollegeForm">
                <div class="input-group">
                    {{--<input class="form-control" name="college_info_id" type="text" placeholder="所属学院">--}}
                    <select class="form-control" name="college_info_id">
                        <option value="">所属学院</option>
                        @foreach($date1 as $college)
                            <option value="{{$college->college_info_id}}"{{ $college->college_info_id == old('StudentInfo')['college_info_id'] ? 'selected' : '' }}>
                                {{$college->college_name}}
                            </option>
                        @endforeach
                    </select>
                    <span class="input-group-btn"><a onclick="searchTeacherCollege()" class="btn btn-primary">搜索</a></span>
                </div>
                <script type="text/javascript">
                    function searchTeacherCollege() {
                        document.getElementById("searchTeacherCollegeForm").submit();
                    }
                </script>
            </form><br>
        </div>

        {{--所属教研室搜索框--}}
        <div class="col-md-4 col-sm-4 col-lg-3">
            <form role="form" class="form-horizontal" method="get" action="{{url('admin/manageInfo/Teacher')}}" id="searchTeacherSectionForm">
                <div class="input-group">
                    {{--<input class="form-control" name="section_info_id" type="text" placeholder="所属教研室">--}}
                    <select class="form-control" name="section_info_id">
                        <option value="">所属教研室</option>
                        @foreach($date2 as $section)
                            <option value="{{$section->section_info_id}}"{{ $section->section_info_id == old('TeacherInfo')['section_info_id'] ? 'selected' : '' }}>
                                {{$section->section_name}}
                            </option>
                        @endforeach
                    </select>
                    <span class="input-group-btn"><a onclick="searchTeacherSection()" class="btn btn-primary">搜索</a></span>
                </div>
                <script type="text/javascript">
                    function searchTeacherSection() {
                        document.getElementById("searchTeacherSectionForm").submit();
                    }
                </script>
            </form><br>
        </div>

        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>操作管理</th>
                    <th>教师工号</th>
                    <th>教师名称</th>
                    <th>所属学院</th>
                    <th>所属教研室</th>
                    <th>职称</th>
                    <th>可指导最大学生数</th>
                    {{--<th>学位</th>--}}
                    {{--<th>邮箱地址</th>--}}
                    {{--<th>电话号码</th>--}}
                    {{--<th>QQ号</th>--}}
                    {{--<th>微信号</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($teacherInfos->sortBy('teacher_job_number') as $teacherInfo)
                    <tr>
                        <td>
                            <a href="{{ url('admin/manageInfo/teacherDetail',['id'=>$teacherInfo->teacher_info_id] )}}">详情</a>
                            <a href="{{ url('admin/manageInfo/teacherUpdate',['id'=>$teacherInfo->teacher_info_id] )}}">修改</a>
                            <a href="{{ url('admin/manageInfo/teacherDelete',['id'=>$teacherInfo->teacher_info_id] )}}"
                               onclick="if (confirm('确定要删除这条教师信息吗？') == false) return false;">删除</a>
                        </td>
                        <th>{{$teacherInfo->teacher_job_number}}</th>
                        {{--教师工号--}}
                        <th>{{$teacherInfo->teacher_name}}</th>
                        {{--教师名称--}}
                        <th>{{$teacherInfo->college_info_id($teacherInfo->college_info_id)}}</th>
                        {{--所属学院--}}
                        <th>{{$teacherInfo->section_info_id($teacherInfo->section_info_id)}}</th>
                        {{--所属教研室--}}
                        <th>{{$teacherInfo->positional_title}}</th>
                        {{--职称--}}
                        <th>{{$teacherInfo->max_students}}</th>
                        {{--可指导最大学生数--}}
                        {{--<th>{{$teacherInfo->academic_degree}}</th>--}}
                        {{--学位--}}
                        {{--<th>{{$teacherInfo->mail_address}}</th>--}}
                        {{--邮箱地址--}}
                        {{--<th>{{$teacherInfo->phone_number}}</th>--}}
                        {{--电话号码--}}
                        {{--<th>{{$teacherInfo->qq_number}}</th>--}}
                        {{--QQ号--}}
                        {{--<th>{{$teacherInfo->wechart_name}}</th>--}}
                        {{--微信号--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{--分页--}}
    <div>
        <div class="pull-left">
            {{ $teacherInfos->render() }}
        </div>
    </div>
@stop