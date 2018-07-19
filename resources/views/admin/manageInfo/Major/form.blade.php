<form class="form-horizontal" role="form" method="post" action="">
    {{csrf_field()}}
    {{--专业编号--}}
    <div class="form-group {{$errors->has('MajorInfo.major_identifier') ?  'has-error' : ''}}">
        <label for="major_identifier" class="col-sm-2 control-label"><a class="text-danger">*</a>专业编号</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="major_identifier" name="MajorInfo[major_identifier]" placeholder="请输入长度为一至三位有效数字的专业编号 [ 格式如：1]"
                   value="{{old('MajorInfo')['major_identifier'] == null ? (isset($majorInfo['major_identifier']) ?
                                $majorInfo->major_identifier: old('MajorInfo')['major_identifier']) : old('MajorInfo')['major_identifier']}}">
            <label class="control-label text-danger" for="major_identifier">{{ $errors->first('MajorInfo.major_identifier') }}</label>
        </div>
    </div>
    {{--专业名称--}}
    <div class="form-group {{$errors->has('MajorInfo.major_name') ?  'has-error' : ''}}">
        <label for="major_name" class="col-sm-2 control-label"><a class="text-danger">*</a>专业名称</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="_name" name="MajorInfo[major_name]" placeholder="请输入专业名称（长度为一至十） [ 格式如：软件工程]"
                   value="{{old('MajorInfo')['major_name'] == null ? (isset($majorInfo['major_name']) ?
                                $majorInfo->major_name: old('MajorInfo')['major_name']) : old('MajorInfo')['major_name']}}">
            <div>
                <label class="control-label" for="class_name">{{$errors->first('MajorInfo.major_name')}}</label>
            </div>
        </div>
    </div>
    {{--所属学院--}}
    <div class="form-group {{$errors->has('MajorInfo.college_info_id') ?  'has-error' : ''}}">
        <label for="college_info_id" class="col-sm-2 control-label"><a class="text-danger">*</a>所属学院</label>
        <div class="col-sm-8">
            <select class="form-control" id="college_info_id" name="MajorInfo[college_info_id]">
                <option value="">--请选择所属学院--</option>
                @foreach($collegeInfos as $collegeInfo)
                    <option value="{{$collegeInfo->college_info_id}}"{{ $collegeInfo->college_info_id == (old('MajorInfo')['college_info_id']==null? $majorInfo->college_info_id: old('Major')['college_info_id'])? 'selected' : ''}}>
                        {{$collegeInfo->college_name}}
                    </option>
                @endforeach
            </select>
            <label class="control-label" for="college_info_id">{{$errors->first('MajorInfo.college_info_id')}}</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-6">
            <button type="submit" id="createBtn" class="btn btn-primary">提交</button>
            <a   href="#"   class="btn btn-primary" onclick="javascript:history.back();">返回</a>
        </div>
    </div>

</form>