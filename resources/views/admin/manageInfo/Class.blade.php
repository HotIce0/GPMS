@extends('layouts.layoutSidebar')

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
            <h3 class="panel-title">班级信息管理</h3>
            <div class="right">
                <a href="{{url('#')}}"><span class="label label-primary"><i class="fa fa-plus-square"></i>&nbsp;新增班级</span></a>
        </div>
        </div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
             <tr>
                {{--<td>--}}
                    {{--<a href="{{ url('student/detail', ['id' => $student->id]) }}">详情</a>--}}
                    {{--<a href="{{ url('student/update', ['id' => $student->id]) }}">修改</a>--}}
                    {{--<a href="{{ url('student/delete', ['id' => $student->id]) }}"--}}
                       {{--onclick="if (confirm('确定要删除吗？') == false) return false;">删除</a>--}}
                {{--</td>--}}

                <th>操作</th>
                <th>班级编号</th>
                <th>班级名称</th>
                <th>所属学院</th>
            </tr>
            </thead>
            <tbody>
                @foreach($classInfos as $classInfo)
                <tr>
                    <td>
                        <a href="{{ '#' }}">修改</a>
                        <a href="{{ '#' }}"
                           onclick="if (confirm('确定要删除吗？') == false) return false;">删除</a>
                    </td>
                    <th>{{ $classInfo->class_identifier}}</th>
                    <th>{{ $classInfo->class_name}}</th>
                    <th>{{ $classInfo->class_info_id}}</th>
                </tr>
                @endforeach
                </tr>
            </tbody>
    </table>

    </div>
</div>

@endsection
