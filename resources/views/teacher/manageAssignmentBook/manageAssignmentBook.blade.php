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
    <!-- MY PROJECTS STATUS -->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">任务书管理</h3>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                {{-- 2.11教师操作自己的任务书的权限 --}}
                @can('permission', '2.11')
                    <th>操作</th>
                @endcan
                <th>序号</th>
                <th>课题名称</th>
                <th>课题类型</th>
                <th>课题来源</th>
                <th>对学生要求</th>
                <th>课题申报状态</th>
                <th>题目被选状态</th>
                <th>修改意见</th>
            </tr>
            </thead>
                <tbody>
                @foreach($data['projects'] as $project)
                    <tr>
                        {{-- 2.11教师操作自己的任务书的权限 --}}
                        @can('permission', '2.11')
                            {{--操作--}}
                            <td>

                            </td>
                        @endcan
                    </tr>
                </tbody>
        </table>
    </div>
    <!-- END MY PROJECTS STATUS -->
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
@endsection