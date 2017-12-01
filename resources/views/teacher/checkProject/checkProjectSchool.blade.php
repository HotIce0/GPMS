@extends('layouts.layoutSidebar')

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
            <h3 class="panel-title">待审选题</h3>
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
                    <th>序号</th>
                    <th>课题名称</th>
                    <th>课题类型</th>
                    <th>课题来源</th>
                    <th>对学生要求</th>
                    <th>教师</th>
                    <th>职称</th>
                    <th>课题审查状态</th>
                    <th>审查</th>
                </tr>
                </thead>
                <form class="form-horizontal" id="projectsForm" role="form" method="post" action="{{url('/createProject/adoptProjectsSchool')}}">
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
                    <td>{{$project->project_id}}</td>
                    <td>{{$project->project_name}}</td>
                    <td>{{$data['projectTypes'][$project->project_type]->item_content}}</td>
                    <td>{{$data['projectOrigins'][$project->project_origin]->item_content}}</td>
                    <td>{{$project->require_for_student}}</td>
                    <td>{{$project->teacher_name}}</td>
                    <td>{{$project->positional_title}}</td>
                    <td><span class="label label-success">学院审查通过</span></td>
                    <td>
                        <a href="{{url('/createProject/checkProjectDetailSchool', $project->project_id)}}"><span class="label label-info">审查</span></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
                </form>
            </table>
        </div>
        <div class="panel-footer">
            <div class="col-md-2">
                <form class="form-inline" id="pageNumForm" role="form" method="get" action="{{url('createProject/checkProjectSchool')}}">
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
                <button type="button" id="btnAtopt" class="btn btn-success ">采纳选中项</button>
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
    <!-- GET URL PARAM -->
    <script>
        $("option#"+$("#SelectPages").html()).prop("selected", true);//改变选项内容
    </script>
    <!-- END GET URL PARAM -->
@endsection