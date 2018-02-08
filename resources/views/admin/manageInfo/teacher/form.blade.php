{{--By LHW--}}
<form class="form-horizontal" role="form" method="post" action="">
    {{csrf_field()}}
    {{--教师工号--}}
    <div class="form-group {{$errors->has('teacher_job_number') ?  'has-error' : ''}}">
        <label for="teacher_job_number" class="col-sm-2 control-label"><a class="text-danger">*</a>教师工号</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="teacher_job_number" name="TeacherInfo[teacher_job_number]" placeholder="请输入教师工号"
                   value="{{ old('TeacherInfo') ['teacher_job_number'] ? old('TeacherInfo') ['teacher_job_number'] : $teacherInfo->teacher_job_number }}">
            <label class="control-label text-danger" for="teacher_job_number">{{ $errors->first('TeacherInfo.teacher_job_number') }}</label>
        </div>
    </div>

    {{--教师名称--}}
    <div class="form-group {{$errors->has('teacher_name') ?  'has-error' : ''}}">
        <label for="teacher_name" class="col-sm-2 control-label"><a class="text-danger">*</a>教师名称</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="teacher_name" name="TeacherInfo[teacher_name]" placeholder="请输入教师名称"
                   value="{{ old('TeacherInfo')['teacher_name'] ? old('TeacherInfo')['teacher_name'] : $teacherInfo->teacher_name }}">
            <label class="control-label text-danger" for="teacher_name">{{ $errors->first('TeacherInfo.teacher_name') }}</label>
        </div>
    </div>

    {{--所属学院--}}
    <div class="form-group">
        <label for="college_info_id" class="col-sm-2 control-label"><a class="text-danger">*</a>所属学院</label>
        <div class="col-sm-8">
            <select class="form-control" id="college_info_id" name="TeacherInfo[college_info_id]">
                @foreach($teacherInfo->college_info_id() as $ind1=>$val1)
                    {{--{{ isset($teacherInfo->college_info_id) && $teacherInfo->college_info_id == $ind1 ? 'checked' : '' }}--}}
                    <option value= "{{$ind1}}">{{ $val1 }}</option>
                @endforeach
            </select>
            <label class="control-label text-danger" for="college_info_id">{{ $errors->first('TeacherInfo.college_info_id') }}</label>
        </div>
    </div>

    {{--所属教研室--}}
    <div class="form-group">
        <label for="section_info_id" class="col-sm-2 control-label"><a class="text-danger">*</a>所属教研室</label>
        <div class="col-sm-8">
            <select class="form-control" id="section_info_id" name="TeacherInfo[section_info_id]">
                @foreach($teacherInfo->section_info_id() as $ind2=>$val2)
                    {{--{{ isset($teacherInfo->section_info_id) && $teacherInfo->section_info_id == $ind2 ? 'checked' : '' }}--}}
                    <option value= "{{$ind2}}">{{ $val2 }}</option>
                @endforeach
            </select>
            <label class="control-label text-danger" for="section_info_id">{{ $errors->first('TeacherInfo.section_info_id') }}</label>
        </div>
    </div>

    {{--职称--}}
    <div class="form-group {{$errors->has('positional_title') ?  'has-error' : ''}}">
        <label for="positional_title" class="col-sm-2 control-label"><a class="text-danger">*</a>职称</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="positional_title" name="TeacherInfo[positional_title]" placeholder="请输入教师职称"
                   value="{{ isset(old('TeacherInfo')['positional_title']) && old('TeacherInfo')['positional_title'] ? old('TeacherInfo')['positional_title'] :$teacherInfo->positional_title }}">
            <label class="control-label text-danger" for="positional_title">{{ $errors->first('TeacherInfo.positional_title') }}</label>
        </div>
    </div>

    {{--可指导最大学生数--}}
    <div class="form-group {{$errors->has('max_students') ?  'has-error' : ''}}">
        <label for="max_students" class="col-sm-2 control-label"><a class="text-danger">*</a>可指导最大学生数</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="max_students" name="TeacherInfo[max_students]" placeholder="请输入该教师可指导的最大学生数"
                   value="{{ isset(old('TeacherInfo')['max_students']) && old('TeacherInfo')['max_students'] ? old('TeacherInfo')['max_students'] : $teacherInfo->max_students }}">
            <label class="control-label text-danger" for="max_students">{{ $errors->first('TeacherInfo.max_students') }}</label>
        </div>
    </div>

    {{--学位--}}
    <div class="form-group {{$errors->has('academic_degree') ?  'has-error' : ''}}">
        <label for="academic_degree" class="col-sm-2 control-label"><a class="text-danger">*</a>学位</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="academic_degree" name="TeacherInfo[academic_degree]" placeholder="请输入该教师的学位"
                   value="{{ old('TeacherInfo')['academic_degree'] ? old('TeacherInfo')['academic_degree'] : $teacherInfo->academic_degree }}">
            <label class="control-label text-danger" for="academic_degree">{{ $errors->first('TeacherInfo.academic_degree') }}</label>
        </div>
    </div>

    {{--邮箱地址--}}
    <div class="form-group {{$errors->has('mail_address') ?  'has-error' : ''}}">
        <label for="mail_address" class="col-sm-2 control-label"><a class="text-danger">*</a>邮箱地址</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="mail_address" name="TeacherInfo[mail_address]" placeholder="请输入邮箱地址"
                   value="{{ old('TeacherInfo')['mail_address'] ? old('TeacherInfo')['mail_address'] : $teacherInfo->mail_address }}">
            <label class="control-label text-danger" for="mail_address">{{ $errors->first('TeacherInfo.mail_address') }}</label>
        </div>
    </div>

    {{--电话号码--}}
    <div class="form-group {{$errors->has('phone_number') ?  'has-error' : ''}}">
        <label for="phone_number" class="col-sm-2 control-label"><a class="text-danger">*</a>电话号码</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="phone_number" name="TeacherInfo[phone_number]" placeholder="请输入电话号码"
                   value="{{ old('TeacherInfo')['phone_number'] ? old('TeacherInfo')['phone_number'] : $teacherInfo->phone_number }}">
            <label class="control-label text-danger" for="phone_number">{{ $errors->first('TeacherInfo.phone_number') }}</label>
        </div>
    </div>

    {{--QQ号--}}
    <div class="form-group {{$errors->has('qq_number') ?  'has-error' : ''}}">
        <label for="qq_number" class="col-sm-2 control-label"><a class="text-danger">*</a>QQ号</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="qq_number" name="TeacherInfo[qq_number]" placeholder="请输入QQ号"
                   value="{{ old('TeacherInfo')['qq_number'] ? old('TeacherInfo')['qq_number'] : $teacherInfo->qq_number }}">
            <label class="control-label text-danger" for="qq_number">{{ $errors->first('TeacherInfo.qq_number') }}</label>
        </div>
    </div>

    {{--微信号--}}
    <div class="form-group {{$errors->has('wechart_name') ?  'has-error' : ''}}">
        <label for="wechart_name" class="col-sm-2 control-label"><a class="text-danger">*</a>微信号</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="wechart_name" name="TeacherInfo[wechart_name]" placeholder="请输入微信号"
                   value="{{ old('TeacherInfo')['wechart_name'] ? old('TeacherInfo')['wechart_name'] : $teacherInfo->wechart_name }}">
            <label class="control-label text-danger" for="wechart_name">{{ $errors->first('TeacherInfo.wechart_name') }}</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-5 col-sm-6">
            <button type="submit" class="btn btn-primary">提交</button>
            <a  class="btn btn-primary" href="{{ url('manageInfo/Teacher') }}">返回</a>
        </div>
    </div>

</form>