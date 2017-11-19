@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    欢迎
                    @can('admin')
                        管理员
                    @elsecan('student')
                        学生
                    @elsecan('teacher')
                        老师
                    @endcan
                    登陆
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
