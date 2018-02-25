@extends('layouts.layoutSidebar')
{{--By xiaoming--}}

@section('sidebar')
    @include('admin.sidebar')
@endsection

@section('content')
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">新增教研室信息填写</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="post" action="">
                {{csrf_field()}}
                {{--教研室名称--}}
                <div class="form-group {{$errors->has('SectionInfo.section_name') ?  'has-error' : ''}}">
                    <label for="section_name" class="col-sm-2 control-label"><a class="text-danger">*</a>教研室名称</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="section_name" name="SectionInfo[section_name]" placeholder="请输入教研室名称（长度为一至十） [ 格式如：软件工程教研室]"
                                value="{{old('SectionInfo')['section_name'] == null ? (isset($sectionInfos['section_name']) ?
                                $sectionInfos['section_name']->section_name: old('SectionInfo')['section_name']) : old('SectionInfo')['section_name']}}">
                        <div>
                            <label class="control-label" for="class_name">{{$errors->first('SectionInfo.section_name')}}</label>
                        </div>
                    </div>
                </div>
                {{--所属学院--}}
                <div class="form-group {{$errors->has('SectionInfo.college_info_id') ?  'has-error' : ''}}">
                    <label for="college_info_id" class="col-sm-2 control-label"><a class="text-danger">*</a>所属学院</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="college_info_id" name="SectionInfo[college_info_id]">
                            <option value="">--请选择所属学院--</option>
                            @foreach($collegeInfos as $collegeInfo)
                                <option value="{{$collegeInfo->college_info_id}}"{{ $collegeInfo->college_info_id == old('SectionInfo')['college_info_id'] ? 'selected' : '' }}>
                                    {{$collegeInfo->college_name}}
                                </option>
                            @endforeach
                        </select>
                        <label class="control-label" for="college_info_id">{{$errors->first('SectionInfo.college_info_id')}}</label>
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