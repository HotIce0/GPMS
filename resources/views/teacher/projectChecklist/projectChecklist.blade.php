@extends('layouts.layoutSidebar')

@section('sidebar')
    @include('teacher.sidebar')
@endsection

@section('content')
    <!-- CHECK PROJECT CHECKLIST -->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">填写选题审查表</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="post" action="{{url('/createProject/projectChecklist')}}">
                {{csrf_field()}}
                <div class="form-group {{$errors->has('projectName') ?  'has-error' : ''}}">
                    <label for="projectName" class="col-sm-2 control-label">课题名称</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="projectName" name="projectName" placeholder="请输入课题名称[不超过80字]" value="{{ old('projectName') }}">
                        <label class="control-label" for="projectName">{{$errors->first('projectName')}}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="projectType" class="col-sm-2 control-label">课题类型</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="projectType" name="projectType" selected="{{old('projectType')}}">
                            @foreach($data['projectType'] as $item)
                                <option value="{{$item->item_content_id}}" {{!empty(old('projectType')) && $item->item_content_id == old('projectType') ? 'selected' : ''}}>
                                    {{$item->item_content}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="projectOrigin" class="col-sm-2 control-label">课题来源</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="projectOrigin" name="projectOrigin">
                            @foreach($data['projectOrigin'] as $item)
                                <option value="{{$item->item_content_id}}" {{!empty(old('projectOrigin')) && $item->item_content_id == old('projectOrigin') ? 'selected' : ''}}>
                                    {{$item->item_content}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group {{$errors->has('requireForStudent') ?  'has-error' : ''}}">
                    <label for="requireForStudent" class="col-sm-2 control-label">对学生的要求</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="3" id="requireForStudent" name="requireForStudent">{{old('requireForStudent')}}</textarea>
                        <label class="control-label" for="requireForStudent">{{$errors->first('requireForStudent')}}</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">提交申请</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <!-- END PROJECT CHECKLIST -->
@endsection