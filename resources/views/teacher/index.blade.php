@extends('layouts.layoutSidebar')

@section('sidebar')
    @include('teacher.sidebar')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        欢迎
                        @can('admin')
                            {{Auth::user()->user_name}} 管理员
                        @elsecan('student')
                            {{Auth::user()->user_name}} 同学
                        @elsecan('teacher')
                            {{Auth::user()->user_name}} 老师
                        @endcan
                        登陆
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection