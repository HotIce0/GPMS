@extends('layouts.layoutSidebar')
{{--yusir--}}

@section('sidebar')
    @include('admin.sidebar')

@endsection


@section('content')
    <form method="post" action="{{ url('admin/manageInfo/student') }}">
        {{csrf_field()}}
        <div class="panel">
            <div class="panel-heading" >
                <h4>选择搜索条件</h4>
            </div>
            <div class="panel-body">
                <div class="col-sm-offset-3 col-sm-5">
                    <select class="form-control" name="Search[college_info_id]" id="college_info_id">
                        <option value="0">选择学院</option>
                        @foreach($college as $v)
                            <option value="{{ $v['college_info_id']}}" >{{ $v['college_name'] }}</option>
                        @endforeach
                    </select>
                    <br>
                </div>
                <div class="col-sm-offset-3 col-sm-5">
                    <select class="form-control" name="Search[major_info_id]" id="major_info_id">
                        <option value="0">选择专业</option>
                        @foreach($major as $v)
                            <option value="{{ $v['major_info_id'] }}">{{ $v['major_name']}}</option>
                        @endforeach
                    </select>
                    <br>
                </div>
                <div class="col-sm-offset-3 col-sm-5">
                    <select class="form-control" name="Search[class_info_id]" id="class_info_id">
                        <option value="0">选择班级</option>
                        @foreach($class as $v)
                            <option value="{{ $v->class_info_id }}">{{ $v->class_name}}</option>
                        @endforeach
                    </select>
                    <br>
                </div>

                <div class="col-sm-offset-5 col-sm-6">
                    <button type="submit" class="btn btn-primary">搜索</button>
                </div>
            </div>
        </div>
    </form>
@stop
