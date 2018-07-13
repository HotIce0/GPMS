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
        <!-- DATETIMEPICKER -->
        <link rel="stylesheet" href="{{asset('assets/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css')}}">
@endsection

@section('sidebar')
    @include('teacher.sidebar')
@endsection

@section('content')
    <!-- ERROR TIP -->
    @if(Session::has('successMsg'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-check-circle"></i> {{Session::get('successMsg')}}
        </div>
    @endif
    @if(Session::has('failureMsg'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-times-circle"></i> {{Session::get('failureMsg')}}
        </div>
    @endif
    <!-- END ERROR TIP -->
    <!-- CHECK LIST -->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">题目审查(学院)</h3>
        </div>
        <div class="panel-body no-padding">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>
                        <!-- SELECT ALL -->
                        <label class="fancy-checkbox">
                            <input type="checkbox" id="selectAll"/>
                            <span></span>
                        </label>
                        <!-- END SELECT ALL -->
                    </th>
                    <th>审查</th>
                    <th>序号</th>
                    <th>课题名称</th>
                    <th>课题类型</th>
                    <th>课题来源</th>
                    <th>对学生要求</th>
                    <th>教师</th>
                    <th>职称</th>
                    <th>课题审查状态</th>
                </tr>
                </thead>
                <form class="form-horizontal" id="projectsForm" role="form" method="post" action="{{url('/teacher/createProject/adoptProjects')}}">
                    {{csrf_field()}}
                <tbody>
                @foreach($data['projects'] as $project)
                <tr>
                    <td>
                        <label class="fancy-checkbox">
                            <input type="checkbox" id="projectCheckbox" name="projectCheckbox[{{$project->project_id}}]" value="{{$project->project_id}}">
                            <span></span>
                        </label>
                    </td>
                    <td>
                        <a href="{{url('/teacher/createProject/checkProjectDetail', $project->project_id)}}"><span class="label label-primary">审查</span></a>
                    </td>
                    <td>{{$project->project_id}}</td>
                    <td>{{$project->project_name}}</td>
                    <td>{{$data['projectTypes'][$project->project_type]->item_content}}</td>
                    <td>{{$data['projectOrigins'][$project->project_origin]->item_content}}</td>
                    <td>{{$project->require_for_student}}</td>
                    <td>{{$project->teacher_name}}</td>
                    <td>{{$project->positional_title}}</td>
                    <td><i class="fa fa-spinner fa-spin"></i>题目待审</td>
                </tr>
                @endforeach
                </tbody>
                <!-- SET TIME MODAL BEGIN -->
                <div class="modal fade" id="timeSetModal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="modalTitle">请设置任务书下达提醒时间</h4>
                            </div>
                            <div class="modal-body">
                                <!-- DATETIMEPICKER BEGIN -->
                                <div class="form-group">
                                    <label for="dtp_input1" class="col-md-2 control-label"></label>
                                    <div class="input-group date form_datetime col-md-6" data-link-field="dtp_input1">
                                        <input class="form-control" name="remindTime" value="2018-01-01 00:00:00" size="16" type="text" value="" readonly>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                    </div>
                                    <input type="hidden" id="dtp_input1" value="" /><br/>
                                </div>
                                <!-- DATETIMEPICKER END -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                <button type="button" class="btn btn-primary" id="btnAtopt">确定</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal -->
                </div>
                <!-- SET TIME MODAL END -->
                </form>
            </table>
        </div>
        <div class="panel-footer">
            <div class="col-md-2">
                <form class="form-inline" id="pageNumForm" role="form" method="get" action="{{url('/teacher/createProject/checkProject')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <select title="显示行数" id="selectPages" name="selectPages" class="form-control field">
                            <option value="10" id="10">显示10行</option>
                            <option value="25" id="25">显示25行</option>
                            <option value="50" id="50">显示50行</option>
                            <option value="100" id="100">显示100行</option>
                            <option value="250" id="250">显示250行</option>
                            <option value="500" id="500">显示500行</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="text-right">
                <!-- <button type="button" id="btnAtopt" class="btn btn-success ">采纳选中项</button> -->
                <button type="button" data-toggle="modal" data-target="#timeSetModal" class="btn btn-success ">采纳选中项</button>
            </div>
        </div>
    </div>
    {!! $data['projects']->links() !!}
    <!-- END CHECK LIST -->
    <p style="display: none" id="SelectPages">{{Session::get('selectPages')}}</p>
@endsection

@section('page-script')
    <!-- Javascript -->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
    <script src="{{asset('assets/vendor/chartist/js/chartist.min.js')}}"></script>
    <script src="{{asset('assets/scripts/klorofil-common.js')}}"></script>
    <!-- DATETIMEPICKER -->
    <script type="text/javascript" src="{{asset('assets/vendor/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{asset('assets/vendor/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js')}}" charset="UTF-8"></script>

    <!-- SELECT ALL SCRIPT -->
    <script>
        $('input[id="selectAll"]').click(function(){
            //alert(this.checked);
            if($(this).is(':checked')){
                $('input[id="projectCheckbox"]').each(function(){
                    //此处如果用attr，会出现第三次失效的情况
                    $(this).prop("checked",true);
                });
            }else{
                $('input[id="projectCheckbox"]').each(function(){
                    $(this).removeAttr("checked",false);
                });
                //$(this).removeAttr("checked");
            }
        });
    </script>
    <!-- END SELECT ALL SCRIPT -->
    <!-- SELECT AND CLICK SUBMIT -->
    <script>
        $(document).ready(function(){
            //页面行数改变，提交表格
            $("#selectPages").change(function(){
                $("#pageNumForm").submit();
            });
            //采纳按钮点击，提交表格
            $("#btnAtopt").click(function () {
                $("#projectsForm").submit();
            });
        });
    </script>
    <!-- END SELECT AND CLICK SUBMIT -->
    <!-- GET SELECT PAGES FROM INPUT -->
    <script>
        $("option#"+$("#SelectPages").html()).prop("selected", true);//改变选项内容
    </script>
    <!-- END GET SELECT PAGES FROM INPUT -->
    <!-- DATETIMEPICKER BEGIN -->
    <script type="text/javascript">
        $('.form_datetime').datetimepicker({
            language:  'zh-CN',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            format:"yyyy-mm-dd hh:ii"
        });
    </script>
    <!-- DATETIMEPICKER END -->
@endsection