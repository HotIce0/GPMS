@extends('layouts.layoutSidebar')
{{--by xiaoming--}}
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

    <div class="panel">
        <div class="panel-heading" >
            <h3 class="panel-title">学院信息管理</h3>
            <div class="right">
                <a href="{{url('/admin/manageInfo/collegeCreate')}}"><span class="label label-primary"><i class="fa fa-plus-square"></i>&nbsp;新增学院</span></a>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>操作管理</th>
                    <th>学院编号</th>
                    <th>学院名称</th>
                </tr>
                </thead>
                <tbody>
                @foreach($collegeInfos as $collegeInfo)
                    <tr>
                        <td>
                            <a href="{{ url('/admin/manageInfo/collegeUpdate',['id' => $collegeInfo->college_info_id])}}">修改</a>
                            <a href="{{ url('/admin/manageInfo/collegeDelete',['id' => $collegeInfo->college_info_id])}}"
                               onclick="if (confirm('确定要删除吗？') == false) return false;">删除</a>
                        </td>
                        {{--班级编号--}}
                        <th>{{ $collegeInfo->college_identifier}}</th>
                        {{--班级名称--}}
                        <th>{{ $collegeInfo->college_name}}</th>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        {{--分页--}}
        <div class="pull-left">
            {{ $collegeInfos->render() }}
        </div>
    </div>

@endsection