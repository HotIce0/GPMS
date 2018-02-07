@extends('layouts.layoutSidebar')
{{--By Sao Guang--}}

@section('head')
    <title></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/linearicons/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/chartist/css/chartist-custom.css')}}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/favicon.png')}}">
    <link href="{{asset('assets/vendor/select2/select2.min.css')}}" rel="stylesheet">
@endsection

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
            <form class="form-horizontal" role="form" method="post" action="{{url('/teacher/createProject/projectChecklist')}}">
                {{csrf_field()}}
                <div class="form-group" style="display: none">
                    <input type="text" class="form-control" name="projectID" value="{{isset($data['project']) ? $data['project']->project_id : ''}}">
                </div>
                <div class="form-group" style="display: none">
                    <input id="reservation" type="text" class="form-control" name="reservation" value="">
                </div>
                <div class="form-group {{$errors->has('projectName') ?  'has-error' : ''}}">
                    <label for="projectName" class="col-sm-2 control-label"><a class="text-danger">*</a>课题名称</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="projectName" name="projectName" placeholder="请输入课题名称[不超过80字]"
                               value="{{old('projectName') == null ? (isset($data['project']) ? $data['project']->project_name: old('projectName')) : old('projectName')}}"
                        >
                        <label class="control-label" for="projectName">{{$errors->first('projectName')}}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="projectType" class="col-sm-2 control-label"><a class="text-danger">*</a>课题类型</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="projectType" name="projectType">
                            @foreach($data['projectType'] as $item)
                                <option value="{{$item->item_content_id}}" {{$item->item_content_id == (old('projectType') == null ? (isset($data['project']) ? $data['project']->project_type: old('projectType')) : old('projectType')) ? 'selected' : ''}}>
                                    {{$item->item_content}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="projectOrigin" class="col-sm-2 control-label"><a class="text-danger">*</a>课题来源</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="projectOrigin" name="projectOrigin">
                            @foreach($data['projectOrigin'] as $item)
                                <option value="{{$item->item_content_id}}" {{$item->item_content_id == (old('projectOrigin') == null ? (isset($data['project']) ? $data['project']->project_origin: old('projectOrigin')) : old('projectOrigin')) ? 'selected' : ''}}>
                                    {{$item->item_content}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group {{$errors->has('requireForStudent') ?  'has-error' : ''}}">
                    <label for="requireForStudent" class="col-sm-2 control-label">对学生的要求</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="3" id="requireForStudent" name="requireForStudent">{{old('requireForStudent') == null ? (isset($data['project']) ? $data['project']->require_for_student: old('requireForStudent')) : old('requireForStudent')}}</textarea>
                        <label class="control-label" for="requireForStudent">{{$errors->first('requireForStudent')}}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="studentID" class="col-sm-2 control-label">指定学生</label>
                    <div class="col-sm-8">
                        <select id="studentSelect" name="studentSelect" class="form-control required js-example-placeholder-single js-states">
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-6">
                        <button type="submit" id="tempReservation" class="btn btn-info">题目暂存</button>
                        <button type="submit" id="createBtn" class="btn btn-primary">提交申请</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <!-- END PROJECT CHECKLIST -->
@endsection

@section('page-script')
    <!-- Javascript -->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
    <script src="{{asset('assets/vendor/chartist/js/chartist.min.js')}}"></script>
    <script src="{{asset('assets/scripts/klorofil-common.js')}}"></script>
    <script src="{{asset('assets/vendor/select2/select2.min.js')}}"></script>
    <!-- CLICK SUBMIT -->
    <script>
        $(document).ready(function(){
            <!-- INITIALIZE SELECT2 -->
            $("#studentSelect").select2({
                ajax:{
                    url:"{{url('/teacher/createProject/getStudentInfoByName')}}",
                    dataType:'json',
                    delay:250,
                    data:function (params) {
                        return {
                            search:params.term
                        }
                    },
                    cache:true
                },
                placeholder: '请输入学生姓名',
                allowClear:true,
            });
            <!-- END INITIALIZE SELECT2 -->
            $("button#tempReservation").click(function () {
                $("input#reservation").val('true');
            });
            $("button#createBtn").click(function () {
                $("input#reservation").val('');
            });
            $("input[name='studentID']").on('input',function () {
                $.post("getStudentInfoByName",{
                    '_token':'{{csrf_token()}}',
                    'name':$("input[name='studentID']").val()
                }, function (data,status) {
                    var arrStuInfo = JSON.parse(data);
                    alert("第一个学生名字:" + arrStuInfo[0]['student_name'] + "  第一个学生学号:" + arrStuInfo[0]['student_number']);
                });
            });
        });
    </script>
    <!-- END CLICK SUBMIT -->
@endsection