@extends('layouts.layoutSidebar')
{{--By Sao Guang--}}
@section('sidebar')
    @include('teacher.sidebar')
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

    <!-- MY PROJECTS APPLICATION -->
    {{--@if($data['selected'])--}}
        {{--<div class="panel">--}}
            {{--<div class="panel-heading">--}}
                {{--<h3 class="panel-title">来自学生的选题申请</h3>--}}
                {{--<div class="right">--}}
                    {{--<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>--}}
                    {{--<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="panel-body">--}}
                {{--<table class="table table-hover">--}}
                    {{--<thead>--}}
                    {{--<tr>--}}
                        {{--<th>序号</th>--}}
                        {{--<th>课题名称</th>--}}
                        {{--<th>课题类型</th>--}}
                        {{--<th>课题来源</th>--}}
                        {{--<th>对学生要求</th>--}}
                        {{--<th>学号</th>--}}
                        {{--<th>学生姓名</th>--}}
                        {{--<th>所属班级</th>--}}
                        {{--<th>所学专业</th>--}}
                        {{--<th>学生信息详情</th>--}}
                        {{--<th>操作</th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}
                    {{--@foreach($data['projectApplications'] as $projectApplication)--}}
                        {{--<tr>--}}
                            {{--<td>{{$projectApplication->project_id}}</td>--}}
                            {{--<td>{{$projectApplication->project_name}}</td>--}}
                            {{--<td>{{$data['projectTypes'][$projectApplication->project_type]->item_content}}</td>--}}
                            {{--<td>{{$data['projectOrigins'][$projectApplication->project_origin]->item_content}}</td>--}}
                            {{--<td>{{$projectApplication->require_for_student}}</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                    {{--</tbody>--}}
                {{--</table>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--@endif--}}
    <!-- END MY PROJECTS APPLICATION -->

    <!-- MY PROJECTS STATUS -->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">我的课题</h3>
            {{-- 2.1是出题权限 --}}
            @can('permission', '2.1')
                <div class="right">
                    <a href="{{url('createProject/projectChecklist')}}"><span class="label label-primary"><i class="fa fa-plus-square"></i>&nbsp;添加课题</span></a>
                </div>
            @endcan
        </div>
        <div class="panel-body no-padding">
            <table class="table table-hover">
                <thead>
                <tr>
                    {{-- 2.6教师操作自己的选题申请的权限 --}}
                    @can('permission', '2.6')
                        <th>操作</th>
                    @endcan
                    <th>序号</th>
                    <th>课题名称</th>
                    <th>课题类型</th>
                    <th>课题来源</th>
                    <th>对学生要求</th>
                    <th>课题申报状态</th>
                    <th>修改意见</th>
                </tr>
                </thead>
                <form class="form-horizontal" id="projectsForm" role="form" method="post" action="{{url('/createProject/adoptProjects')}}">
                    {{csrf_field()}}
                <tbody>
                @foreach($data['projects'] as $project)
                <tr>
                    {{-- 2.6教师操作自己的选题申请的权限 --}}
                    @can('permission', '2.6')
                        {{--操作--}}
                        <td>
                            @if($project->project_declaration_status == '1')
                                {{--暂存状态--}}
                                <a href="{{url('createProject/projectChecklist', $project->project_id), $project->project_id}}"><span class="label label-primary">编辑</span></a>
                                <a href="{{url('createProject/deleteProject', $project->project_id)}}" onclick="return confirm('确定要删除这条课题申请吗？');"><span class="label label-danger">删除</span></a>
                            @elseif($project->project_declaration_status == '2')
                                {{--等待院部审查状态--}}
                                <a href="{{url('createProject/cancelProjectApplication', $project->project_id)}}" onclick="return confirm('确定要取消这条课题申请吗？');"><span class="label label-danger">取消申请</span></a>
                            @elseif($project->project_declaration_status == '3')
                                {{--等待学校审查状态--}}
                                <a href="{{url('createProject/cancelProjectApplication', $project->project_id)}}" onclick="return confirm('确定要取消这条课题申请吗？');"><span class="label label-danger">取消申请</span></a>
                            @elseif($project->project_declaration_status == '4')
                                {{--院部审查未通过状态--}}
                                <a href="{{url('createProject/projectChecklist', $project->project_id), $project->project_id}}"><span class="label label-primary">编辑</span></a>
                                <a href="{{url('createProject/deleteProject', $project->project_id)}}" onclick="return confirm('确定要删除这条课题申请吗？');"><span class="label label-danger">删除</span></a>
                            @elseif($project->project_declaration_status == '5')
                                {{--审查通过状态--}}
                            @elseif($project->project_declaration_status == '6')
                                {{--学校审查未通过状态--}}
                                <a href="{{url('createProject/projectChecklist', $project->project_id), $project->project_id}}"><span class="label label-primary">编辑</span></a>
                                <a href="{{url('createProject/deleteProject', $project->project_id)}}" onclick="return confirm('确定要删除这条课题申请吗？');"><span class="label label-danger">删除</span></a>
                            @endif
                        </td>
                    @endcan
                    <td>{{$project->project_id}}</td>
                    <td>{{$project->project_name}}</td>
                    <td>{{$data['projectTypes'][$project->project_type]->item_content}}</td>
                    <td>{{$data['projectOrigins'][$project->project_origin]->item_content}}</td>
                    <td>{{$project->require_for_student}}</td>
                    {{--课题申报状态--}}
                    <td>
                        @if($project->project_declaration_status == '1')
                            暂存
                        @elseif($project->project_declaration_status == '2')
                            <i class="fa fa-spinner fa-spin"></i>等待院部审查
                        @elseif($project->project_declaration_status == '3')
                            <i class="fa fa-spinner fa-spin"></i>等待学校审查
                        @elseif($project->project_declaration_status == '4')
                            <span style="color: red"><i class="fa fa-warning"></i>院部审查未通过</span>
                        @elseif($project->project_declaration_status == '5')
                            <span style="color: green"><i class="fa fa-check-circle"></i>审查通过</span>
                        @elseif($project->project_declaration_status == '6')
                            <span style="color: red"><i class="fa fa-warning"></i>学校审查未通过</span>
                        @endif
                    </td>
                    {{--修改意见--}}
                    <td>
                        @if($project->amendment == null)
                            无
                        @else
                            {{$project->amendment}}
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
                </form>
            </table>
        </div>
        <div class="panel-footer">
            <div class="col-md-2">
                <form class="form-inline" id="pageNumForm" role="form" method="get" action="{{url('createProject/ManageProjects')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <select title="显示行数" id="selectPages" name="selectPages" class="form-control field">
                            <option value="10" id="10">显示10行</option>
                            <option value="25" id="25">显示25行</option>
                            <option value="50" id="50">显示50行</option>
                            <option value="100" id="100">显示100行</option>
                            <option value="250" id="250">显示250行</option>
                            <option value="500" id="500">显示500行</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MY PROJECTS STATUS -->
    {!! $data['projects']->links() !!}
    <p style="display: none" id="SelectPages">{{Session::get('selectPages')}}</p>
@endsection


@section('page-script')
    <!-- Javascript -->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
    <script src="{{asset('assets/vendor/chartist/js/chartist.min.js')}}"></script>
    <script src="{{asset('assets/scripts/klorofil-common.js')}}"></script>
    <!-- END Javascript -->
    <!-- SELECT -->
    <script>
        $(document).ready(function(){
            //页面行数改变，提交表格
            $("#selectPages").change(function(){
                $("#pageNumForm").submit();
            });
        });
    </script>
    <!-- END SELECT -->
    <!-- GET SELECT PAGES FROM INPUT -->
    <script>
        $("option#"+$("#SelectPages").html()).prop("selected", true);//改变选项内容
    </script>
    <!-- END GET SELECT PAGES FROM INPUT -->
@endsection