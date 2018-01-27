@extends('layouts.layoutSidebar')

@section('sidebar')
    @include('teacher.sidebar')
@endsection
@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>操作</th>
                <th>ID</th>
                <th>课题名称</th>
                <th>学生姓名</th>
                <th>版本</th>
                <th>状态</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($s_open as $student_open)
                <tr>
                    <td>
                        <a href="{{url('/teacher/review')}}/{{$student_open->opening_report_id}}/{{$student_open->project_id}}"><button class="btn btn-link" value="">审查</button></a>
                    </td>
                    <td>{{ $student_open->opening_report_id }}</td>
                    <td>{{$student_open->project_name}}</td>
                    <td>{{$student_open->user_name}}</td>
                    <td>{{ $student_open->version_number }}</td>
                    @if($student_open->opening_report_status=='未过审')
                        <td style="color: red">{{$student_open->opening_report_status}}</td>
                    @elseif($student_open->opening_report_status=='过审')
                        <td style="color: green">{{$student_open->opening_report_status}}</td>
                    @elseif($student_open->opening_report_status=='审查中')
                        <td style="color: blue">{{$student_open->opening_report_status}}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-center">
        {{ $s_open->links() }}
    </div>
@endsection