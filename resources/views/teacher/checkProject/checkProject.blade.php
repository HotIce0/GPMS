@extends('layouts.layoutSidebar')

@section('sidebar')
    @include('teacher.sidebar')
@endsection

@section('content')
    <!-- CHECK LIST -->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">待审选题</h3>
        </div>
        <div class="panel-body no-padding">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>课题名称</th>
                    <th>课题类型</th>
                    <th>课题来源</th>
                    <th>对学生要求</th>
                    <th>教师</th>
                    <th>学位</th>
                    <th>职称</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                {{--@foreach()--}}
                <tr>
                    <td></td>
                    <td>Steve</td>
                    <td>$122</td>
                    <td>Oct 21, 2016</td>
                    <td><span class="label label-success">COMPLETED</span></td>
                    <td><span class="label label-success">COMPLETED</span></td>
                    <td><span class="label label-success">COMPLETED</span></td>
                    <td><span class="label label-success">骚</span></td>
                </tr>
                </tbody>
                {{--@endforeach--}}
            </table>
        </div>
    </div>
    <!-- END CHECK LIST -->
@endsection