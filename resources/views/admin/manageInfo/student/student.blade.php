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
            <h3 class="panel-title">学生信息管理</h3>
            <div class="right">
                <a href="{{ url('admin/manageInfo/studentCreate') }}"><span class="label label-primary"><i class="fa fa-plus-square"></i>&nbsp;新增学生</span></a>
            </div>
        </div>
        {{--学生学号搜索框--}}
        <div class="col-md-4 col-sm-4 col-lg-3">
            <form role="form" class="form-horizontal" method="get" action="{{url('admin/manageInfo/Student')}}" id="searchStudentNumberForm">
                <div class="input-group">
                    <input class="form-control" name="student_number" type="text" placeholder="请输入学生学号">
                    <span class="input-group-btn"><a onclick="searchStudentNumber()" class="btn btn-primary">搜索</a></span>
                </div>
                <script type="text/javascript">
                    function searchStudentNumber() {
                        document.getElementById("searchStudentNumberForm").submit();
                    }
                </script>
            </form><br>
        </div>

        {{--学生姓名搜索框--}}
        <div class="col-md-4 col-sm-4 col-lg-3">
            <form role="form" class="form-horizontal" method="get" action="{{url('admin/manageInfo/Student')}}" id="searchStudentNameForm">
                <div class="input-group">
                    <input class="form-control" name="student_name" type="text" placeholder="请输入学生姓名">
                    <span class="input-group-btn"><a onclick="searchStudentName()" class="btn btn-primary">搜索</a></span>
                </div>
                <script type="text/javascript">
                    function searchStudentName() {
                        document.getElementById("searchStudentNameForm").submit();
                }
                </script>
            </form><br>
        </div>

        {{--所属学院搜索框--}}
        <div class="col-md-4 col-sm-4 col-lg-2">
            <form role="form" class="form-horizontal" method="get" action="{{url('admin/manageInfo/Student')}}" id="searchStudentCollegeForm">
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
                    <span class="input-group-btn"><a onclick="searchStudentCollege()" class="btn btn-primary">搜索</a></span>
                </div>
                <script type="text/javascript">
                    function searchStudentCollege() {
                        document.getElementById("searchStudentCollegeForm").submit();
                    }
                </script>
            </form><br>
        </div>

        {{--所学专业搜索框--}}
        <div class="col-md-4 col-sm-4 col-lg-2">
            <form role="form" class="form-horizontal" method="get" action="{{url('admin/manageInfo/Student')}}" id="searchStudentMajorForm">
                <div class="input-group">
                    {{--<input class="form-control" name="major_info_id" type="text" placeholder="所学专业">--}}
                    <select class="form-control" name="major_info_id">
                        <option value="">所学专业</option>
                        @foreach($date3 as $major)
                            <option value="{{$major->major_info_id}}"{{ $major->major_info_id == old('StudentInfo')['major_info_id'] ? 'selected' : '' }}>
                                {{$major->major_name}}
                            </option>
                        @endforeach
                    </select>
                    <span class="input-group-btn"><a onclick="searchStudentMajor()" class="btn btn-primary">搜索</a></span>
                </div>
                <script type="text/javascript">
                    function searchStudentMajor() {
                        document.getElementById("searchStudentMajorForm").submit();
                    }
                </script>
            </form><br>
        </div>

        {{--所属班级搜索框--}}
        <div class="col-md-4 col-sm-4 col-lg-2">
            <form role="form" class="form-horizontal" method="get" action="{{url('admin/manageInfo/Student')}}" id="searchStudentClassForm">
                <div class="input-group">
                    {{--<input class="form-control" name="class_info_id" type="text" placeholder="所属班级">--}}
                    <select class="form-control" name="class_info_id">
                        <option value="">所属班级</option>
                        @foreach($date2 as $class)
                            <option value="{{$class->class_info_id}}"{{ $class->class_info_id == old('StudentInfo')['class_info_id'] ? 'selected' : '' }}>
                                {{$class->class_name}}
                            </option>
                        @endforeach
                    </select>
                    <span class="input-group-btn"><a onclick="searchStudentClass()" class="btn btn-primary">搜索</a></span>
                </div>
                <script type="text/javascript">
                    function searchStudentClass() {
                        document.getElementById("searchStudentClassForm").submit();
                    }
                </script>
            </form><br>
        </div>

        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>操作管理</th>
                    <th>学号</th>
                    <th>学生名称</th>
                    <th>所属学院</th>
                    <th>所学专业</th>
                    <th>所属班级</th>
                    {{--<th>身份证号码</th>--}}
                    {{--<th>邮箱地址</th>--}}
                    {{--<th>电话号码</th>--}}
                    {{--<th>QQ号</th>--}}
                    {{--<th>微信号</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($studentInfos->sortBy('student_number') as $studentInfo)
                    <tr>
                        <td>
                            <a href="{{ url('admin/manageInfo/studentDetail',['id'=>$studentInfo->student_info_id] )}}">详情</a>
                            <a href="{{ url('admin/manageInfo/studentUpdate',['id'=>$studentInfo->student_info_id] )}}">修改</a>
                            <a href="{{ url('admin/manageInfo/studentDelete',['id'=>$studentInfo->student_info_id] )}}"
                                     onclick="if (confirm('确定要删除这条学生信息吗？') == false) return false;">删除</a>
                        </td>
                        <th>{{$studentInfo->student_number}}</th>
                        {{--学号--}}
                        <th>{{$studentInfo->student_name}}</th>
                        {{--学生名称--}}
                        <th>{{$studentInfo->college_info_id($studentInfo->college_info_id)}}</th>
                        {{--所属班级--}}
                        <th>{{$studentInfo->major_info_id($studentInfo->major_info_id)}}</th>
                        {{--所属学院--}}
                        <th>{{$studentInfo->class_info_id($studentInfo->class_info_id)}}</th>
                        {{--所学专业--}}
                        {{--<th>{{$studentInfo->identity_card_number}}</th>--}}
                        {{--身份证号码--}}
                        {{--<th>{{$studentInfo->mail_address}}</th>--}}
                        {{--邮箱地址--}}
                        {{--<th>{{$studentInfo->phone_number}}</th>--}}
                        {{--电话号码--}}
                        {{--<th>{{$studentInfo->qq_number}}</th>--}}
                        {{--QQ号--}}
                        {{--<th>{{$studentInfo->wechart_name}}</th>--}}
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
            {{ $studentInfos->render() }}
        </div>
    </div>


@stop