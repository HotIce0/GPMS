{{--By LHW--}}   {{--移除   留作备份--}}
{{--<form class="form-horizontal" role="form" method="post" action="">--}}
    {{--{{csrf_field()}}--}}
    {{--专业编号--}}
    {{--<div class="form-group {{$errors->has('MajorInfo.major_identifier') ?  'has-error' : ''}}">--}}
        {{--<label for="major_identifier" class="col-sm-2 control-label"><a class="text-danger">*</a>专业编号</label>--}}
        {{--<div class="col-sm-8">--}}
            {{--<input type="text" class="form-control" id="major_identifier" name="MajorInfo[major_identifier]" placeholder="请输入专业编号"--}}
                   {{--value="{{ old('MajorInfo') ['major_identifier'] ? old('MajorInfo') ['major_identifier'] : $majorInfo->major_identifier }}">--}}
            {{--<label class="control-label text-danger" for="major_identifier">{{ $errors->first('MajorInfo.major_identifier') }}</label>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--专业名称--}}
    {{--<div class="form-group {{$errors->has('MajorInfo.major_name') ?  'has-error' : ''}}">--}}
        {{--<label for="major_name" class="col-sm-2 control-label"><a class="text-danger">*</a>专业名称</label>--}}
        {{--<div class="col-sm-8">--}}
            {{--<input type="text" class="form-control" id="major_name" name="MajorInfo[major_name]" placeholder="请输入专业名称"--}}
                   {{--value="{{ old('MajorInfo')['major_name'] ? old('MajorInfo')['major_name'] : $majorInfo->major_name }}">--}}
            {{--<label class="control-label text-danger" for="major_name">{{ $errors->first('MajorInfo.major_name') }}</label>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--所属学院--}}
    {{--<div class="form-group">--}}
        {{--<label for="college_info_id" class="col-sm-2 control-label"><a class="text-danger">*</a>所属学院</label>--}}
        {{--<div class="col-sm-8">--}}
            {{--<select class="form-control" id="college_info_id" name="MajorInfo[college_info_id]">--}}
                {{--@foreach($majorInfo->college_info_id() as $ind=>$val)--}}
                    {{--{{ isset($teacherInfo->college_info_id) && $teacherInfo->college_info_id == $ind1 ? 'checked' : '' }}--}}
                    {{--<option value= "{{$ind}}">{{ $val }}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
            {{--<label class="control-label text-danger" for="college_info_id">{{ $errors->first('MajorInfo.college_info_id') }}</label>--}}
        {{--</div>--}}
    {{--</div>--}}


    {{--<div class="form-group">--}}
        {{--<div class="col-sm-offset-5 col-sm-6">--}}
            {{--<button type="submit" class="btn btn-primary">提交</button>--}}
            {{--<a  class="btn btn-primary" href="{{ url('manageInfo/Major') }}">返回</a>--}}
        {{--</div>--}}
    {{--</div>--}}

{{--</form>--}}