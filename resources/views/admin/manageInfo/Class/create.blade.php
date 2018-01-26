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
                <div class="form-group {{$errors->has('class_identifier') ?  'has-error' : ''}}">
                    <label for="class_identifier" class="col-sm-2 control-label"><a class="text-danger">*</a>班级编号</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="class_identifier" name="ClassInfo[class_identifier]" placeholder="请输入长度为四位有效数字的班级编号 [ 格式如：1607]"
                                value="{{old('ClassInfo')['class_identifier'] == null ? (isset($classInfos['class_identifier']) ?
                                $classInfos['class_identifier']->class_identifier: old('ClassInfo')['class_identifier']) : old('ClassInfo')['class_identifier']}}">
                    </div>
                    <div class="col-sm-5">
                        <label class="control-label" for="class_identifier">{{$errors->first('Class.class_identifier')}}</label>
                    </div>
                </div>
                {{--班级名称--}}
                <div class="form-group {{$errors->has('class_name') ?  'has-error' : ''}}">
                    <label for="class_name" class="col-sm-2 control-label"><a class="text-danger">*</a>班级名称</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="class_name" name="ClassInfo[class_name]" placeholder="请输入班级名称（中间不能有空格） [ 格式如：软件16-2BF]"
                                value="{{old('ClassInfo')['class_name'] == null ? (isset($classInfos['class_name']) ?
                                $classInfos['class_name']->class_identifier: old('ClassInfo')['class_name']) : old('ClassInfo')['class_name']}}">
                        <label class="control-label" for="class_name">{{$errors->first('class_name')}}</label>
                    </div>
                </div>


                {{--创建者名字--}}

                {{--修改者名字--}}

                {{--所属学院--}}
                <div class="form-group">
                    <label for="college_info_id" class="col-sm-2 control-label"><a class="text-danger">*</a>所属学院</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="college_info_id" name="ClassInfo[college_info_id]">
                            @foreach($classInfo->college_info_id() as $ind=>$val)
                            <option value= "{{$ind}}">{{ $val }}</option>
                            @endforeach
                        </select>
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