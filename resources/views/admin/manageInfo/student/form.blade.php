{{--By LHW--}}   {{--移除   留作备份--}}
{{--<form class="form-horizontal" role="form" method="post" action="">--}}
    {{--{{csrf_field()}}--}}
    {{--学号--}}
    {{--<div class="form-group {{$errors->has('StudentInfo.student_number') ?  'has-error' : ''}}">--}}
        {{--<label for="student_number" class="col-sm-2 control-label"><a class="text-danger">*</a>学号</label>--}}
        {{--<div class="col-sm-8">--}}
            {{--<input type="text" class="form-control" id="student_number" name="StudentInfo[student_number]" placeholder="请输入学号"--}}
                   {{--value="{{ old('StudentInfo') ['student_number'] ? old('StudentInfo') ['student_number'] : $studentInfo->student_number }}">--}}
            {{--<label class="control-label text-danger" for="student_number">{{ $errors->first('StudentInfo.student_number') }}</label>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--学生名称--}}
    {{--<div class="form-group {{$errors->has('StudentInfo.student_name') ?  'has-error' : ''}}">--}}
        {{--<label for="student_name" class="col-sm-2 control-label"><a class="text-danger">*</a>学生名称</label>--}}
        {{--<div class="col-sm-8">--}}
            {{--<input type="text" class="form-control" id="student_name" name="StudentInfo[student_name]" placeholder="请输入学生名称"--}}
                   {{--value="{{ old('StudentInfo')['student_name'] ? old('StudentInfo')['student_name'] : $studentInfo->student_name }}">--}}
            {{--<label class="control-label text-danger" for="student_name">{{ $errors->first('StudentInfo.student_name') }}</label>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--所属学院--}}
    {{--<div class="form-group">--}}
        {{--<label for="college_info_id" class="col-sm-2 control-label"><a class="text-danger">*</a>所属学院</label>--}}
        {{--<div class="col-sm-8">--}}
            {{--<select class="form-control" id="college_info_id" name="StudentInfo[college_info_id]">--}}
                {{--@foreach($studentInfo->college_info_id() as $ind1=>$val1)--}}
                    {{--{{ isset($studentInfo->college_info_id) && $studentInfo->college_info_id == $ind1 ? 'checked' : '' }}--}}
                    {{--<option value= "{{$ind1}}">{{ $val1 }}</option>--}}
                {{--@endforeach--}}
                {{--@foreach($date as $college)--}}
                    {{--<option value="{{$college->college_info_id}}">--}}
                        {{--{{$college->college_name}}--}}
                    {{--</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
            {{--<label class="control-label text-danger" for="college_info_id">{{ $errors->first('StudentInfo.college_info_id') }}</label>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--所属班级--}}
    {{--<div class="form-group">--}}
        {{--<label for="class_info_id" class="col-sm-2 control-label"><a class="text-danger">*</a>所属班级</label>--}}
        {{--<div class="col-sm-8">--}}
            {{--<select class="form-control" id="class_info_id" name="StudentInfo[class_info_id]">--}}
                {{--@foreach($studentInfo->class_info_id() as $ind2=>$val2)--}}
                    {{--{{ isset($studentInfo->class_info_id) && $studentInfo->class_info_id == $ind2 ? 'checked' : '' }}--}}
                    {{--<option value= "{{$ind2}}">{{ $val2 }}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
            {{--<label class="control-label text-danger" for="class_info_id">{{ $errors->first('StudentInfo.class_info_id') }}</label>--}}

            {{--@foreach($studentInfo->class_info_id() as $ind2=>$val2)--}}
                {{--<label class="radio-inline">--}}
                       {{--<input type="radio" name="StudentInfo[class_info_id]"--}}
                              {{--{{ $studentInfo->class_info_id == $ind2 ? 'checked' : '' }}--}}
                       {{--value="{{ $ind2 }}">{{ $val2 }}--}}
                {{--</label>--}}
            {{--@endforeach--}}


        {{--</div>--}}
    {{--</div>--}}

    {{--所学专业--}}
    {{--<div class="form-group">--}}
        {{--<label for="major_info_id" class="col-sm-2 control-label"><a class="text-danger">*</a>所学专业</label>--}}
        {{--<div class="col-sm-8">--}}
            {{--<select class="form-control" id="major_info_id" name="StudentInfo[major_info_id]">--}}
                {{--@foreach($studentInfo->major_info_id() as $ind3=>$val3)--}}
                    {{--{{ isset($studentInfo->major_info_id) && $studentInfo->major_info_id == $ind3 ? 'checked' : '' }}--}}
                    {{--<option value= "{{$ind3}}">{{ $val3 }}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
            {{--<label class="control-label text-danger" for="major_info_id">{{ $errors->first('StudentInfo.major_info_id') }}</label>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--身份证号码--}}
    {{--<div class="form-group {{$errors->has('StudentInfo.identity_card_number') ?  'has-error' : ''}}">--}}
        {{--<label for="identity_card_number" class="col-sm-2 control-label"><a class="text-danger">*</a>身份证号码</label>--}}
        {{--<div class="col-sm-8">--}}
            {{--<input type="text" class="form-control" id="identity_card_number" name="StudentInfo[identity_card_number]" placeholder="请输入身份证号码"--}}
                   {{--value="{{ old('StudentInfo')['identity_card_number'] ? old('StudentInfo')['identity_card_number'] :$studentInfo->identity_card_number }}">--}}
            {{--<label class="control-label text-danger" for="identity_card_number">{{ $errors->first('StudentInfo.identity_card_number') }}</label>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--邮箱地址--}}
    {{--<div class="form-group {{$errors->has('StudentInfo.mail_address') ?  'has-error' : ''}}">--}}
        {{--<label for="mail_address" class="col-sm-2 control-label"><a class="text-danger">*</a>邮箱地址</label>--}}
        {{--<div class="col-sm-8">--}}
            {{--<input type="text" class="form-control" id="mail_address" name="StudentInfo[mail_address]" placeholder="请输入邮箱地址"--}}
                   {{--value="{{ old('StudentInfo')['mail_address'] ? old('StudentInfo')['mail_address'] : $studentInfo->mail_address }}">--}}
            {{--<label class="control-label text-danger" for="mail_address">{{ $errors->first('StudentInfo.mail_address') }}</label>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--电话号码--}}
    {{--<div class="form-group {{$errors->has('StudentInfo.phone_number') ?  'has-error' : ''}}">--}}
        {{--<label for="phone_number" class="col-sm-2 control-label"><a class="text-danger">*</a>电话号码</label>--}}
        {{--<div class="col-sm-8">--}}
            {{--<input type="text" class="form-control" id="phone_number" name="StudentInfo[phone_number]" placeholder="请输入电话号码"--}}
                   {{--value="{{ old('StudentInfo')['phone_number'] ? old('StudentInfo')['phone_number'] : $studentInfo->phone_number }}">--}}
            {{--<label class="control-label text-danger" for="phone_number">{{ $errors->first('StudentInfo.phone_number') }}</label>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--QQ号--}}
    {{--<div class="form-group {{$errors->has('StudentInfo.qq_number') ?  'has-error' : ''}}">--}}
        {{--<label for="qq_number" class="col-sm-2 control-label"><a class="text-danger">*</a>QQ号</label>--}}
        {{--<div class="col-sm-8">--}}
            {{--<input type="text" class="form-control" id="qq_number" name="StudentInfo[qq_number]" placeholder="请输入QQ号"--}}
                   {{--value="{{ old('StudentInfo')['qq_number'] ? old('StudentInfo')['qq_number'] : $studentInfo->qq_number }}">--}}
            {{--<label class="control-label text-danger" for="qq_number">{{ $errors->first('StudentInfo.qq_number') }}</label>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--微信号--}}
    {{--<div class="form-group {{$errors->has('StudentInfo.wechart_name') ?  'has-error' : ''}}">--}}
        {{--<label for="wechart_name" class="col-sm-2 control-label"><a class="text-danger">*</a>微信号</label>--}}
        {{--<div class="col-sm-8">--}}
            {{--<input type="text" class="form-control" id="wechart_name" name="StudentInfo[wechart_name]" placeholder="请输入微信号"--}}
                   {{--value="{{ old('StudentInfo')['wechart_name'] ? old('StudentInfo')['wechart_name'] : $studentInfo->wechart_name }}">--}}
            {{--<label class="control-label text-danger" for="wechart_name">{{ $errors->first('StudentInfo.wechart_name') }}</label>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
        {{--<div class="col-sm-offset-5 col-sm-6">--}}
            {{--<button type="submit" class="btn btn-primary">提交</button>--}}
            {{--<a  class="btn btn-primary" href="{{ url('admin/manageInfo/Student') }}">返回</a>--}}
        {{--</div>--}}
    {{--</div>--}}

{{--</form>--}}