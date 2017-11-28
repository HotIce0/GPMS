@extends('layouts.layoutSidebar')

@section('sidebar')
    @include('teacher.sidebar')
@endsection

@section('content')
    <form class="form-horizontal" role="form">

        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">课题名称</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="firstname" placeholder="请输入课题名称[小于80字]">
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">课题类型</label>
            <div class="col-sm-8">
            <select class="form-control">
                <option>1</option>
            </select>
            </div>
        </div>

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">课题来源</label>
            <div class="col-sm-8">
            <select class="form-control">
                <option>1</option>
            </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">确认</button>
            </div>
        </div>

    </form>
@endsection