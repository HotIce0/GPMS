@extends('layouts.layoutSidebar')

@section('sidebar')
    @include('teacher.sidebar')
@endsection

@section('content')
    <!-- CHECK PROJECT CHECKLIST -->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">选题审查</h3>
        </div>
        <div class="panel-body">

            <form class="form-horizontal" role="form" method="post" action="{{url('/createProject/rejectProject')}}">
                {{csrf_field()}}
                <input type="text" style="display: none" class="form-control" id="projectID" name="projectID" value="{{$data['projectChoice']->project_id}}">
                <div class="form-group">
                    <label for="projectName" class="col-sm-2 control-label">课题名称</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control" id="projectName" name="projectName" value="{{$data['projectChoice']->project_name}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="projectType" class="col-sm-2 control-label">课题类型</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control" id="projectType" name="projectType" value="{{$data['projectTypes'][$data['projectChoice']->project_type]->item_content}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="projectOrigin" class="col-sm-2 control-label">课题来源</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control" id="projectOrigin" name="projectOrigin" value="{{$data['projectOrigins'][$data['projectChoice']->project_origin]->item_content}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="requireForStudent" class="col-sm-2 control-label">对学生的要求</label>
                    <div class="col-sm-8">
                        <textarea readonly class="form-control" rows="3" id="requireForStudent" name="requireForStudent">{{$data['projectChoice']->require_for_student}}</textarea>
                    </div>
                </div>

                <div class="form-group {{$errors->has('amendment') ?  'has-error' : ''}}">
                    <label for="amendment" class="col-sm-2 control-label">修改意见</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="3" id="amendment" name="amendment"></textarea>
                        <label class="control-label" for="amendment">{{$errors->first('amendment')}}</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">退回申请</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <!-- END PROJECT CHECKLIST -->
@endsection