@extends('layouts.layoutSidebar')
{{--By LHW--}}

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">学生信息详情</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover ">
                <tbody>
                <tr>
                    <td width="50%">学号</td>
                    <td>{{ $studentInfo->student_number }}</td>
                </tr>
                <tr>
                    <td>学生名称</td>
                    <td>{{ $studentInfo->student_name }}</td>
                </tr>
                <tr>
                    <td>所属学院</td>
                    <td>{{ $studentInfo->college_info_id($studentInfo->college_info_id) }}</td>
                </tr>
                <tr>
                    <td>所属班级</td>
                    <td>{{ $studentInfo->class_info_id($studentInfo->class_info_id) }}</td>
                </tr>
                <tr>
                    <td>所属专业</td>
                    <td>{{ $studentInfo->major_info_id($studentInfo->major_info_id) }}</td>
                </tr>
                <tr>
                    <td>身份证号码</td>
                    <td>{{ $studentInfo->identity_card_number }}</td>
                </tr>
                <tr>
                    <td>邮箱地址</td>
                    <td>{{ $studentInfo->mail_address }}</td>
                </tr>
                <tr>
                    <td>电话号码</td>
                    <td>{{ $studentInfo->phone_number }}</td>
                </tr>
                <tr>
                    <td>QQ号</td>
                    <td>{{ $studentInfo->qq_number }}</td>
                </tr>
                <tr>
                    <td>微信号</td>
                    <td>{{ $studentInfo->wechart_name }}</td>
                </tr>
                <tr>
                    <td>添加日期</td>
                    <td>{{ $studentInfo->created_at }}</td>
                </tr>
                <tr>
                    <td>最后修改</td>
                    <td>{{ $studentInfo->updated_at }}</td>
                </tr>
                </tbody>
            </table>

            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-6">
                    <a  class="btn btn-primary" href="{{ url('manageInfo/studentUpdate',['id'=>$studentInfo->student_info_id]) }}">修改</a>
                    <a  class="btn btn-primary" href="{{ url('manageInfo/Student') }}">返回</a>
                </div>
            </div>

        </div>
    </div>
@stop