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
            <h3 class="panel-title">教研室信息管理</h3>
            <div class="right">
                <a href="{{url('/admin/manageInfo/sectionCreate')}}"><span class="label label-primary"><i class="fa fa-plus-square"></i>&nbsp;新增教研室</span></a>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>操作管理</th>
                    {{--<th>教研室编号</th>--}}
                    <th>教研室名称</th>
                    <th>所属学院</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sectionInfos as $sectionInfo)
                    <tr>
                        <td>
                            <a href="{{ url('/admin/manageInfo/sectionUpdate',['id' => $sectionInfo->section_info_id])}}">修改</a>
                            <a href="{{ url('/admin/manageInfo/sectionDelete',['id' => $sectionInfo->section_info_id])}}"
                               onclick="if (confirm('确定要删除吗？') == false) return false;">删除</a>
                        </td>
                        {{--教研室编号--}}
                        {{--<th>{{ $sectionInfo->section_identifier}}</th>--}}
                        {{--教研室名称--}}
                        <th>{{ $sectionInfo->section_name}}</th>
                        {{--所属学院--}}
                        <th>{{ $sectionInfo->getCollegeInfo["college_name"]}}</th>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection