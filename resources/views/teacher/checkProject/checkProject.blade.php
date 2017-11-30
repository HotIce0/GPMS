@extends('layouts.layoutSidebar')

@section('sidebar')
    @include('teacher.sidebar')
@endsection

@section('content')
    <!-- CHECK LIST -->
    <form class="form-horizontal" role="form" method="post" action="{{url('/createProject/adoptProjects')}}">
        {{csrf_field()}}
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
                    <th>审查</th>
                </tr>
                </thead>
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
                    <td>
                        <a href="#"><span class="label label-info">审查</span></a>
                    </td>
                </tr>
                </tbody>
                @endforeach

            </table>
        </div>
        <div class="panel-footer">
            <div class="text-right">
                <button type="submit" class="btn btn-success">采纳选中项</button>
            </div>
        </div>
    </div>

    </form>
    <!-- END CHECK LIST -->
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
@endsection