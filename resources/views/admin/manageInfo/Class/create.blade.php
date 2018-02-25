@extends('layouts.layoutSidebar')
{{--By xiaoming--}}

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">新增班级信息填写</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="post" action="">
                {{csrf_field()}}
                {{--班级编号--}}
                <div class="form-group {{$errors->has('ClassInfo.class_identifier') ?  'has-error' : ''}}">
                    <label for="class_identifier" class="col-sm-2 control-label"><a class="text-danger">*</a>班级编号</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="class_identifier" name="ClassInfo[class_identifier]" placeholder="请输入长度为四位有效数字的班级编号 [ 格式如：1607]"
                                value="{{old('ClassInfo')['class_identifier'] == null ? (isset($classInfos['class_identifier']) ?
                                $classInfos['class_identifier']->class_identifier: old('ClassInfo')['class_identifier']) : old('ClassInfo')['class_identifier']}}">
                        <label class="control-label text-danger" for="class_identifier">{{ $errors->first('ClassInfo.class_identifier') }}</label>
                    </div>
                </div>
                {{--班级名称--}}
                <div class="form-group {{$errors->has('ClassInfo.class_name') ?  'has-error' : ''}}">
                    <label for="class_name" class="col-sm-2 control-label"><a class="text-danger">*</a>班级名称</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="class_name" name="ClassInfo[class_name]" placeholder="请输入班级名称 [ 格式如：软件16-2BF]"
                                value="{{old('ClassInfo')['class_name'] == null ? (isset($classInfos['class_name']) ?
                                $classInfos['class_name']->class_name: old('ClassInfo')['class_name']) : old('ClassInfo')['class_name']}}">
                        <div>
                            <label class="control-label" for="class_name">{{$errors->first('ClassInfo.class_name')}}</label>
                        </div>
                        <div>
                            <label for="class_name" class="col-sm-pull-6 control-label"><a class="text-danger">班级名称示例:<a>计科16-1BJ&emsp;网络16-1BF&emsp;软件16-2BF</a><a class="text-danger">--中间不能有空格</a></a></label>
                        </div>
                    </div>
                </div>
                {{--所属学院--}}
                <div class="form-group {{$errors->has('ClassInfo.college_info_id') ?  'has-error' : ''}}">
                    <label for="college_info_id" class="col-sm-2 control-label"><a class="text-danger">*</a>所属学院</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="college_info_id" name="ClassInfo[college_info_id]">
                            <option value="">--请选择所属学院--</option>
                            @foreach($collegeInfos as $collegeInfo)
                                <option value="{{$collegeInfo->college_info_id}}"{{ $collegeInfo->college_info_id == old('ClassInfo')['college_info_id'] ? 'selected' : '' }}>
                                    {{$collegeInfo->college_name}}
                                </option>
                            @endforeach
                        </select>
                        <label class="control-label" for="college_info_id">{{$errors->first('ClassInfo.college_info_id')}}</label>
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