@extends('layouts.layoutSidebar')
{{--By LHW--}}

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">专业信息详情</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-hover ">
                <tbody>
                <tr>
                    <td width="50%">专业编号</td>
                    <td>{{ $majorInfo->major_identifier }}</td>
                </tr>
                <tr>
                    <td>专业名称</td>
                    <td>{{ $majorInfo->major_name }}</td>
                </tr>
                <tr>
                    <td>所属学院</td>
                    <td>{{ $majorInfo->college_info_id($majorInfo->college_info_id) }}</td>
                </tr>
                <tr>
                    <td>添加日期</td>
                    <td>{{ $majorInfo->created_at }}</td>
                </tr>
                <tr>
                    <td>最后修改</td>
                    <td>{{ $majorInfo->updated_at }}</td>
                </tr>
                </tbody>
            </table>

            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-6">
                    <a  class="btn btn-primary" href="{{ url('manageInfo/majorUpdate',['id'=>$majorInfo->major_info_id]) }}">修改</a>
                    <a  class="btn btn-primary" href="{{ url('manageInfo/Major') }}">返回</a>
                </div>
            </div>

        </div>
    </div>
@stop