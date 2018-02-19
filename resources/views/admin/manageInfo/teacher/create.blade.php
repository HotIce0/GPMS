@extends('layouts.layoutSidebar')
{{--By LHW--}}

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">新增教师信息填写</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="post" action="">
                {{csrf_field()}}
                {{--教师工号--}}
                <div class="form-group {{$errors->has('TeacherInfo.teacher_job_number') ?  'has-error' : ''}}">
                    <label for="teacher_job_number" class="col-sm-2 control-label"><a class="text-danger">*</a>教师工号</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="teacher_job_number" name="TeacherInfo[teacher_job_number]" placeholder="请输入教师工号"
                               value="{{ old('TeacherInfo') ['teacher_job_number'] }}">
                        {{--<label class="control-label text-danger" for="teacher_job_number">{{ $errors->first('TeacherInfo.teacher_job_number') }}</label>--}}
                        @if($errors->has('TeacherInfo.teacher_job_number'))
                            <label class="control-label text-danger" for="teacher_job_number">{{ $errors->first('TeacherInfo.teacher_job_number') }}</label>
                        @endif
                    </div>
                </div>

                {{--教师名称--}}
                <div class="form-group {{$errors->has('TeacherInfo.teacher_name') ?  'has-error' : ''}}">
                    <label for="teacher_name" class="col-sm-2 control-label"><a class="text-danger">*</a>教师名称</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="teacher_name" name="TeacherInfo[teacher_name]" placeholder="请输入教师名称"
                               value="{{ old('TeacherInfo')['teacher_name'] }}">
                        {{--<label class="control-label text-danger" for="teacher_name">{{ $errors->first('TeacherInfo.teacher_name') }}</label>--}}
                        @if($errors->has('TeacherInfo.teacher_name'))
                            <label class="control-label text-danger" for="teacher_name">{{ $errors->first('TeacherInfo.teacher_name') }}</label>
                        @endif
                    </div>
                </div>

                {{--所属学院--}}
                <div class="form-group {{$errors->has('TeacherInfo.college_info_id') ?  'has-error' : ''}}" >
                    <label for="college_info_id" class="col-sm-2 control-label"><a class="text-danger">*</a>所属学院</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="college_info_id" name="TeacherInfo[college_info_id]">
                            <option value="">--请选择所属学院--</option>
                            @foreach($date1 as $college)
                                <option value="{{$college->college_info_id}}"{{ $college->college_info_id == old('TeacherInfo')['college_info_id'] ? 'selected' : '' }}>
                                    {{$college->college_name}}
                                </option>
                            @endforeach
                        </select>
                        {{--<label class="control-label text-danger" for="college_info_id">{{ $errors->first('TeacherInfo.college_info_id') }}</label>--}}
                        @if($errors->has('TeacherInfo.college_info_id'))
                            <label class="control-label text-danger" for="college_info_id">{{ $errors->first('TeacherInfo.college_info_id') }}</label>
                        @endif
                    </div>
                </div>

                {{--所属教研室--}}
                <div class="form-group {{$errors->has('TeacherInfo.section_info_id') ?  'has-error' : ''}}" >
                    <label for="section_info_id" class="col-sm-2 control-label"><a class="text-danger">*</a>所属教研室</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="section_info_id" name="TeacherInfo[section_info_id]">
                            <option value="">--请选择所属教研室--</option>
                            @foreach($date2 as $section)
                                <option value="{{$section->section_info_id}}"{{ $section->section_info_id == old('TeacherInfo')['section_info_id'] ? 'selected' : '' }}>
                                    {{$section->section_name}}
                                </option>
                            @endforeach
                        </select>
                        {{--<label class="control-label text-danger" for="section_info_id">{{ $errors->first('TeacherInfo.section_info_id') }}</label>--}}
                        @if($errors->has('TeacherInfo.section_info_id'))
                            <label class="control-label text-danger" for="section_info_id">{{ $errors->first('TeacherInfo.section_info_id') }}</label>
                        @endif
                    </div>
                </div>

                {{--职称--}}
                <div class="form-group {{$errors->has('TeacherInfo.positional_title') ?  'has-error' : ''}}">
                    <label for="positional_title" class="col-sm-2 control-label"><a class="text-danger">*</a>职称</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="positional_title" name="TeacherInfo[positional_title]" placeholder="请输入教师职称"
                               value="{{ old('TeacherInfo')['positional_title'] }}">
                        {{--<label class="control-label text-danger" for="positional_title">{{ $errors->first('TeacherInfo.positional_title') }}</label>--}}
                        @if($errors->has('TeacherInfo.positional_title'))
                            <label class="control-label text-danger" for="positional_title">{{ $errors->first('TeacherInfo.positional_title') }}</label>
                        @endif
                    </div>
                </div>

                {{--可指导最大学生数--}}
                <div class="form-group {{$errors->has('TeacherInfo.max_students') ?  'has-error' : ''}}">
                    <label for="max_students" class="col-sm-2 control-label"><a class="text-danger">*</a>可指导最大学生数</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="max_students" name="TeacherInfo[max_students]" placeholder="请输入该教师可指导的最大学生数"
                               value="{{ old('TeacherInfo')['max_students'] }}">
                        {{--<label class="control-label text-danger" for="max_students">{{ $errors->first('TeacherInfo.max_students') }}</label>--}}
                        @if($errors->has('TeacherInfo.max_students'))
                            <label class="control-label text-danger" for="max_students">{{ $errors->first('TeacherInfo.max_students') }}</label>
                        @endif
                    </div>
                </div>

                {{--学位--}}
                <div class="form-group {{$errors->has('TeacherInfo.academic_degree') ?  'has-error' : ''}}">
                    <label for="academic_degree" class="col-sm-2 control-label"><a class="text-danger">*</a>学位</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="academic_degree" name="TeacherInfo[academic_degree]" placeholder="请输入该教师的学位"
                               value="{{ old('TeacherInfo')['academic_degree'] }}">
                        {{--<label class="control-label text-danger" for="academic_degree">{{ $errors->first('TeacherInfo.academic_degree') }}</label>--}}
                        @if($errors->has('TeacherInfo.academic_degree'))
                            <label class="control-label text-danger" for="academic_degree">{{ $errors->first('TeacherInfo.academic_degree') }}</label>
                        @endif
                    </div>
                </div>

                {{--邮箱地址--}}
                <div class="form-group {{$errors->has('TeacherInfo.mail_address') ?  'has-error' : ''}}">
                    <label for="mail_address" class="col-sm-2 control-label"><a class="text-danger">*</a>邮箱地址</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="mail_address" name="TeacherInfo[mail_address]" placeholder="请输入邮箱地址"
                               value="{{ old('TeacherInfo')['mail_address'] }}">
                        {{--<label class="control-label text-danger" for="mail_address">{{ $errors->first('TeacherInfo.mail_address') }}</label>--}}
                        @if($errors->has('TeacherInfo.mail_address'))
                            <label class="control-label text-danger" for="mail_address">{{ $errors->first('TeacherInfo.mail_address') }}</label>
                        @endif
                    </div>
                </div>

                {{--电话号码--}}
                <div class="form-group {{$errors->has('TeacherInfo.phone_number') ?  'has-error' : ''}}">
                    <label for="phone_number" class="col-sm-2 control-label"><a class="text-danger">*</a>电话号码</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="phone_number" name="TeacherInfo[phone_number]" placeholder="请输入电话号码"
                               value="{{ old('TeacherInfo')['phone_number'] }}">
                        {{--<label class="control-label text-danger" for="phone_number">{{ $errors->first('TeacherInfo.phone_number') }}</label>--}}
                        @if($errors->has('TeacherInfo.phone_number'))
                            <label class="control-label text-danger" for="phone_number">{{ $errors->first('TeacherInfo.phone_number') }}</label>
                        @endif
                    </div>
                </div>

                {{--QQ号--}}
                <div class="form-group {{$errors->has('TeacherInfo.qq_number') ?  'has-error' : ''}}">
                    <label for="qq_number" class="col-sm-2 control-label"><a class="text-danger">*</a>QQ号</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="qq_number" name="TeacherInfo[qq_number]" placeholder="请输入QQ号"
                               value="{{ old('TeacherInfo')['qq_number'] }}">
                        {{--<label class="control-label text-danger" for="qq_number">{{ $errors->first('TeacherInfo.qq_number') }}</label>--}}
                        @if($errors->has('TeacherInfo.qq_number'))
                            <label class="control-label text-danger" for="qq_number">{{ $errors->first('TeacherInfo.qq_number') }}</label>
                        @endif
                    </div>
                </div>

                {{--微信号--}}
                <div class="form-group {{$errors->has('TeacherInfo.wechart_name') ?  'has-error' : ''}}">
                    <label for="wechart_name" class="col-sm-2 control-label"><a class="text-danger">*</a>微信号</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="wechart_name" name="TeacherInfo[wechart_name]" placeholder="请输入微信号"
                               value="{{ old('TeacherInfo')['wechart_name'] }}">
                        {{--<label class="control-label text-danger" for="wechart_name">{{ $errors->first('TeacherInfo.wechart_name') }}</label>--}}
                        @if($errors->has('TeacherInfo.wechart_name'))
                            <label class="control-label text-danger" for="wechart_name">{{ $errors->first('TeacherInfo.wechart_name') }}</label>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-6">
                        <button type="submit" class="btn btn-primary">提交</button>
                        <a  class="btn btn-primary" href="{{ url('manageInfo/Teacher') }}">返回</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop