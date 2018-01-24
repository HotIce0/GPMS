<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                {{--概览--}}
                <li><a href="{{url('/teacher')}}" class="{{Request::getPathInfo()=="/teacher"?"active":""}}"><i class="lnr lnr-home"></i><span>概览</span></a></li>
                {{--出题模块--}}
                <li>
                    <a href="#createProject" data-toggle="collapse" class="collapsed {{substr_count(url()->current(), 'createProject') > 0 ? 'active' : ''}}"><i class="lnr lnr-file-empty"></i> <span>出题、选题阶段</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="createProject" class="collapse ">
                        <ul class="nav">
                            {{-- 2.2是审题权限(学院级别) --}}
                            @can('permission', '2.2')
                                <li><a href="{{url('createProject/checkProject')}}" class="">题目审查(学院)</a></li>
                            @endcan
                            {{-- 2.3是审题权限(学校级别) --}}
                            @can('permission', '2.3')
                                <li><a href="{{url('createProject/checkProjectSchool')}}" class="">题目审查(学校)</a></li>
                            @endcan
                            {{-- 2.5是教师查看选题申请的权限 --}}
                            @can('permission', '2.5')
                                <li><a href="{{url('createProject/ManageProjects')}}" class="">我的课题</a></li>
                            @endcan
                                <li><a href="#" class="">我的历届课题</a></li>
                            {{-- 2.10 是教师查看任务书的权限 --}}
                            @can('permission', '2.10')
                                <li><a href="{{url('createProject/manageAssignmentBook')}}" class="">管理任务书</a></li>
                            @endcan
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->