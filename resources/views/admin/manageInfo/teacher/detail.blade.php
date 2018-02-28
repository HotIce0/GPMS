@extends('layouts.layoutSidebar')
{{--By LHW--}}

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">教师信息详情</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover ">
                <tbody>
                <tr>
                    <td width="50%">教师工号</td>
                    <td>{{ $teacherInfo->teacher_job_number }}</td>
                </tr>
                <tr>
                    <td>教师名称</td>
                    <td>{{ $teacherInfo->teacher_name }}</td>
                </tr>
                <tr>
                    <td>所属学院</td>
                    <td>{{ $teacherInfo->college_info_id($teacherInfo->college_info_id) }}</td>
                </tr>
                <tr>
                    <td>所属教研室</td>
                    <td>{{ $teacherInfo->section_info_id($teacherInfo->section_info_id) }}</td>
                </tr>
                <tr>
                    <td>职称</td>
                    <td>{{ $teacherInfo->positional_title }}</td>
                </tr>
                <tr>
                    <td>可指导最大学生数</td>
                    <td>{{ $teacherInfo->max_students }}</td>
                </tr>
                <tr>
                    <td>学位</td>
                    <td>{{ $teacherInfo->academic_degree }}</td>
                </tr>
                <tr>
                    <td>邮箱地址</td>
                    <td>{{ $teacherInfo->mail_address }}</td>
                </tr>
                <tr>
                    <td>电话号码</td>
                    <td>{{ $teacherInfo->phone_number }}</td>
                </tr>
                <tr>
                    <td>QQ号</td>
                    <td>{{ $teacherInfo->qq_number }}</td>
                </tr>
                <tr>
                    <td>微信号</td>
                    <td>{{ $teacherInfo->wechart_name }}</td>
                </tr>
                <tr>
                    <td>添加日期</td>
                    <td>{{ $teacherInfo->created_at }}</td>
                </tr>
                <tr>
                    <td>最后修改</td>
                    <td>{{ $teacherInfo->updated_at }}</td>
                </tr>
                </tbody>
            </table>

            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-6">
                    <a  class="btn btn-primary" href="{{ url('admin/manageInfo/teacherUpdate',['id'=>$teacherInfo->teacher_info_id]) }}">修改</a>
                    <a href="#" class="btn btn-primary" onclick="javascript:history.back()">返回</a>
                </div>
            </div>

        </div>
    </div>
@stop