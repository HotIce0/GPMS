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
            <h3 class="panel-title">专业信息回收</h3>
            <div class="right">
                <a href="{{ url('manageInfo/majorRecycleAll') }}"
                   onclick="if (confirm('确定要全部回收这些专业信息吗？') == false) return false;"
                ><span class="label label-primary"><i class="fa fa-plus-square"></i>&nbsp;全部回收</span></a>
                <a href="{{ url('manageInfo/majorRemoveAll') }}"
                   onclick="if (confirm('确定要全部彻底删除这些专业信息吗？') == false) return false;"
                ><span class="label label-primary"><i class="fa fa-plus-square"></i>&nbsp;全部彻底删除</span></a>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>操作管理</th>
                    <th>专业编号</th>
                    <th>专业名称</th>
                    <th>所属学院</th>
                </tr>
                </thead>
                <tbody>
                @foreach($majorInfos as $majorInfo)
                    <tr>
                        <td>
                            <a href="{{ url('manageInfo/majorRecycle',['id'=>$majorInfo->major_info_id] )}}"
                               onclick="if (confirm('确定要回收这条专业信息吗？') == false) return false;">回收</a>
                            <a href="{{ url('manageInfo/majorRemove',['id'=>$majorInfo->major_info_id] )}}"
                               onclick="if (confirm('确定要彻底删除这条专业信息吗？') == false) return false;">彻底删除</a>
                        </td>
                        <th>{{$majorInfo->major_identifier}}</th>
                        {{--专业编号--}}
                        <th>{{$majorInfo->major_name}}</th>
                        {{--专业名称--}}
                        <th>{{$majorInfo->college_info_id($majorInfo->college_info_id)}}</th>
                        {{--所属学院--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {{--分页--}}
    <div>
        <div class="pull-left">
            {{ $majorInfos->render() }}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-5 col-sm-6">
            <a  class="btn btn-primary" href="{{ url('manageInfo/Major') }}">返回</a>
        </div>
    </div>
@stop