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
    <!-- CHECK LIST -->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">我的课题状态</h3>
        </div>
        <div class="panel-body no-padding">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>课题名称</th>
                    <th>课题类型</th>
                    <th>课题来源</th>
                    <th>对学生要求</th>
                    <th>课题申报状态</th>
                    <th>修改意见</th>
                    <th>操作</th>
                </tr>
                </thead>
                <form class="form-horizontal" id="projectsForm" role="form" method="post" action="{{url('/createProject/adoptProjects')}}">
                    {{csrf_field()}}
                <tbody>
                @foreach($data['projects'] as $project)
                <tr>
                    <td>{{$project->project_id}}</td>
                    <td>{{$project->project_name}}</td>
                    <td>{{$data['projectTypes'][$project->project_type]->item_content}}</td>
                    <td>{{$data['projectOrigins'][$project->project_origin]->item_content}}</td>
                    <td>{{$project->require_for_student}}</td>
                    {{--课题申报状态--}}
                    <td>
                        @if($project->project_declaration_status == '1')
                            <span class="label label-default">暂存</span>
                        @elseif($project->project_declaration_status == '2')
                            <span class="label label-info">等待院部审查</span>
                        @elseif($project->project_declaration_status == '3')
                            <span class="label label-primary">等待学校审查</span>
                        @elseif($project->project_declaration_status == '4')
                            <span class="label label-danger">院部审查未通过</span>
                        @elseif($project->project_declaration_status == '5')
                            <span class="label label-success">审查通过</span>
                        @elseif($project->project_declaration_status == '6')
                            <span class="label label-danger">学校审查未通过</span>
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
                    {{--操作--}}
                    <td>
                        @if($project->project_declaration_status == '1')
                            {{--暂存状态--}}
                            <a href="{{url('createProject/projectChecklist', $project->project_id), $project->project_id}}"><span class="label label-info">编辑</span></a>
                            <a href="{{url('createProject/deleteProject', $project->project_id)}}" onclick="return confirm('确定要删除这条课题申请吗？');"><span class="label label-danger">删除</span></a>
                        @elseif($project->project_declaration_status == '2')
                            {{--等待院部审查状态--}}
                            <a href="{{url('createProject/cancelProjectApplication', $project->project_id)}}" onclick="return confirm('确定要取消这条课题申请吗？');"><span class="label label-warning">取消申请</span></a>
                        @elseif($project->project_declaration_status == '3')
                            {{--等待学校审查状态--}}
                            <a href="{{url('createProject/cancelProjectApplication', $project->project_id)}}" onclick="return confirm('确定要取消这条课题申请吗？');"><span class="label label-warning">取消申请</span></a>
                        @elseif($project->project_declaration_status == '4')
                            {{--院部审查未通过状态--}}
                            <a href="{{url('createProject/deleteProject', $project->project_id)}}" onclick="return confirm('确定要删除这条课题申请吗？');"><span class="label label-danger">删除</span></a>
                        @elseif($project->project_declaration_status == '5')
                            {{--审查通过状态--}}
                        @elseif($project->project_declaration_status == '6')
                            {{--学校审查未通过状态--}}
                            <a href="{{url('createProject/deleteProject', $project->project_id)}}" onclick="return confirm('确定要删除这条课题申请吗？');"><span class="label label-danger">删除</span></a>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
                </form>
            </table>
        </div>
    </div>
@endsection