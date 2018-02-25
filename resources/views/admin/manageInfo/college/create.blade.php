@extends('layouts.layoutSidebar')
{{--By xiaoming--}}

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">新增学院信息填写</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="post" action="">
                {{csrf_field()}}
                {{--学院编号--}}
                <div class="form-group {{$errors->has('CollegeInfo.college_identifier') ?  'has-error' : ''}}">
                    <label for="college_identifier" class="col-sm-2 control-label"><a class="text-danger">*</a>学院编号</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="college_identifier" name="CollegeInfo[college_identifier]" placeholder="请输入长度为一至三位有效数字的学院编号 [ 格式如：1]"
                                value="{{old('CollegeInfo')['college_identifier'] == null ? (isset($collegeInfos['college_identifier']) ?
                                $classInfos['college_identifier']->college_identifier: old('CollegeInfo')['college_identifier']) : old('CollegeInfo')['college_identifier']}}">
                        <label class="control-label text-danger" for="college_identifier">{{ $errors->first('CollegeInfo.college_identifier') }}</label>
                    </div>
                </div>
                {{--学院名称--}}
                <div class="form-group {{$errors->has('CollegeInfo.college_name') ?  'has-error' : ''}}">
                    <label for="college_name" class="col-sm-2 control-label"><a class="text-danger">*</a>学院名称</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="college_name" name="CollegeInfo[college_name]" placeholder="请输入学院名称 [ 格式如：计算机学院]"
                                value="{{old('CollegeInfo')['college_name'] == null ? (isset($collegeInfos['college_name']) ?
                                $classInfos['college_name']->class_identifier: old('CollegeInfo')['college_name']) : old('CollegeInfo')['college_name']}}">
                        <div>
                            <label class="control-label" for="college_name">{{$errors->first('CollegeInfo.college_name')}}</label>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-6">
                        <button type="submit" id="createBtn" class="btn btn-primary">提交</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <!-- END PROJECT CHECKLIST -->
@endsection