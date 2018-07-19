{{--By LYC--}}
<form class="form-horizontal" role="form" method="post" action="">
    {{csrf_field()}}
    {{--教师工号--}}
    <div class="form-group {{$errors->has('TeacherInfo.teacher_job_number') ?  'has-error' : ''}}">
        <label for="teacher_job_number" class="col-sm-2 control-label"><a class="text-danger">*</a>教师工号</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="teacher_job_number" name="TeacherInfo[teacher_job_number]" placeholder="请输入长度为11位有效数字的教师工号 [ 格式如：14162400899]"
                   value="{{old('TeacherInfo')['teacher_job_number'] == null ? (isset($teacherInfo['teacher_job_number']) ?
                    $teacherInfo->teacher_job_number: old('TeacherInfo')['teacher_job_number']) : old('TeacherInfo')['teacher_job_number']}}">
            <label class="control-label text-danger" for="teacher_job_number">{{ $errors->first('TeacherInfo.teacher_job_number') }}</label>
        </div>
    </div>

    {{--教师名称--}}
    <div class="form-group {{$errors->has('TeacherInfo.teacher_name') ?  'has-error' : ''}}">
        <label for="college_name" class="col-sm-2 control-label"><a class="text-danger">*</a>教师名称</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="teacher_name" name="TeacherInfo[teacher_name]" placeholder="请输入教师姓名"
                   value="{{old('TeacherInfo')['teacher_name'] == null ? (isset($teacherInfo['teacher_name']) ?
                    $teacherInfo->teacher_name: old('TeacherInfo')['teacher_name']) : old('TeacherInfo')['teacher_name']}}">
            <div>
                <label class="control-label" for="teacher_name">{{$errors->first('TeacherInfo.teacher_name')}}</label>
            </div>
        </div>
    </div>

    {{--所属院校--}}
    <div class="form-group {{$errors->has('TeacherInfo.college_info_id') ?  'has-error' : ''}}">
        <label for="college_info_id" class="col-sm-2 control-label"><a class="text-danger">*</a>所属学院</label>
        <div class="col-sm-8">
            <select class="form-control" id="college_info_id" name="TeacherInfo[college_info_id]">
                <option value="">--请选择所属学院--</option>
                @foreach($collegeInfos as $collegeInfo)
                    <option value="{{$collegeInfo->college_info_id}}"{{ $collegeInfo->college_info_id == (old('TeacherInfo')['college_info_id']==null? $collegeInfo->college_info_id: old('TeacherInfo')['college_info_id'])? 'selected' : ''}}>
                        {{$collegeInfo->college_name}}
                    </option>
                @endforeach
            </select>
            <label class="control-label" for="college_info_id">{{$errors->first('TeacherInfo.college_info_id')}}</label>
        </div>
    </div>

    {{--所属教研室--}}
    <div class="form-group {{$errors->has('TeacherInfo.section_info_id') ?  'has-error' : ''}}">
        <label for="section_info_id" class="col-sm-2 control-label"><a class="text-danger">*</a>所属教研室</label>
        <div class="col-sm-8">
            <select class="form-control" id="section_info_id" name="TeacherInfo[section_info_id]">
                <option value="">--所属教研室--</option>
                @foreach($sectionInfos as $sectionInfo)
                    <option value="{{$sectionInfo->section_info_id}}"{{ $sectionInfo->section_info_id == (old('TeacherInfo')['section_info_id']==null? $sectionInfo->section_info_id: old('TeacherInfo')['section_info_id'])? 'selected' : ''}}>
                        {{$sectionInfo->section_name}}
                    </option>
                @endforeach
            </select>
            <label class="control-label" for="section_info_id">{{$errors->first('TeacherInfo.section_info_id')}}</label>
        </div>
    </div>

    {{--邮箱地址--}}
    <div class="form-group {{$errors->has('TeacherInfo.mail_address') ?  'has-error' : ''}}">
        <label for="mail_address" class="col-sm-2 control-label"><a class="text-danger">*</a>邮箱地址</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="mail_address" name="TeacherInfo[mail_address]" placeholder="请输入邮箱地址"
                   value="{{old('TeacherInfo')['mail_address'] == null ? (isset($teacherInfo['mail_address']) ?
                    $teacherInfo->mail_address: old('TeacherInfo')['mail_address']) : old('TeacherInfo')['mail_address']}}">
            <label class="control-label text-danger" for="mail_address">{{ $errors->first('TeacherInfo.mail_address') }}</label>
        </div>
    </div>

    {{--电话号码--}}
    <div class="form-group {{$errors->has('TeacherInfo.phone_number') ?  'has-error' : ''}}">
        <label for="phone_number" class="col-sm-2 control-label"><a class="text-danger">*</a>电话号码</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="phone_number" name="TeacherInfo[phone_number]" placeholder="请输入有效长度为11位的电话号码 [格式如：18230505617]"
                   value="{{old('TeacherInfo')['phone_number'] == null ? (isset($teacherInfo['phone_number']) ?
                    $teacherInfo->phone_number: old('TeacherInfo')['phone_number']) : old('TeacherInfo')['phone_number']}}">
            <label class="control-label text-danger" for="phone_number">{{ $errors->first('TeacherInfo.phone_number') }}</label>
        </div>
    </div>

    {{--职称--}}
    <div class="form-group {{$errors->has('TeacherInfo.positional_title') ?  'has-error' : ''}}">
        <label for="positional_title" class="col-sm-2 control-label"><a class="text-danger">*</a>职称</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="positional_title" name="TeacherInfo[positional_title]" placeholder="请输入教师职称"
                   value="{{old('positional_title')['positional_title'] == null ? (isset($teacherInfo['positional_title']) ?
                    $teacherInfo->positional_title: old('TeacherInfo')['positional_title']) : old('TeacherInfo')['positional_title']}}">
            <div>
                <label class="control-label" for="positional_title">{{$errors->first('TeacherInfo.positional_title')}}</label>
            </div>
            <div>
                <label for="positional_title" class="col-sm-pull-6 control-label"><a class="text-danger">教师职称示例:<a>教授    副教授    讲师    辅导员</a></a></label>
            </div>
        </div>
    </div>

    {{--QQ号--}}
    <div class="form-group {{$errors->has('TeacherInfo.qq_number ') ?  'has-error' : ''}}">
        <label for="qq_number" class="col-sm-2 control-label"><a class="text-danger">*</a>QQ号</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="qq_number" name="TeacherInfo[qq_number]" placeholder="请输入QQ号"
                   value="{{old('TeacherInfo')['qq_number'] == null ? (isset($teacherInfo['qq_number']) ?
                    $teacherInfo->qq_number: old('TeacherInfo')['qq_number']) : old('TeacherInfo')['qq_number']}}">
            <label class="control-label text-danger" for="qq_number">{{ $errors->first('TeacherInfo.qq_number') }}</label>
        </div>
    </div>

    {{--微信号--}}
    <div class="form-group {{$errors->has('TeacherInfo.wechart_name ') ?  'has-error' : ''}}">
        <label for="wechart_name" class="col-sm-2 control-label"><a class="text-danger">*</a>微信号</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="wechart_name" name="TeacherInfo[wechart_name]" placeholder="请输入微信号"
                   value="{{old('TeacherInfo')['wechart_name'] == null ? (isset($teacherInfo['wechart_name']) ?
                    $teacherInfo->wechart_name: old('TeacherInfo')['wechart_name']) : old('TeacherInfo')['wechart_name']}}">
            <label class="control-label text-danger" for="wechart_name">{{ $errors->first('TeacherInfo.wechart_name') }}</label>
        </div>
    </div>

    {{--可指导最大学生数--}}
    <div class="form-group {{$errors->has('TeacherInfo.max_studentsmax_students ') ?  'has-error' : ''}}">
        <label for="max_students" class="col-sm-2 control-label"><a class="text-danger">*</a>可指导最大学生数</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="max_students" name="TeacherInfo[max_students]" placeholder="请输入可以指导的最大学生数"
                   value="{{old('TeacherInfo')['max_students'] == null ? (isset($teacherInfo['max_students']) ?
                    $teacherInfo->max_students: old('TeacherInfo')['max_students']) : old('TeacherInfo')['max_students']}}">
            <label class="control-label text-danger" for="max_students">{{ $errors->first('TeacherInfo.max_students') }}</label>
        </div>
    </div>



    <div class="form-group">
        <div class="col-sm-offset-5 col-sm-6">
            <button type="submit" class="btn btn-primary">提交</button>
            <a   href="#"   class="btn btn-primary" onclick="javascript:history.back();">返回</a>
        </div>
    </div>
</form>
