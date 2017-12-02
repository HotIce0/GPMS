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
                            {{-- 2.1是出题权限 --}}
                            @can('permission', '2.1')
                                <li><a href="{{url('/createProject/projectChecklist')}}" class="">申请出题</a></li>
                            @endcan
                            {{-- 2.2是审题权限(学院级别) --}}
                            @can('permission', '2.2')
                                <li><a href="{{url('/createProject/checkProject')}}" class="">题目审查(学院)</a></li>
                            @endcan
                            {{-- 2.3是审题权限(学校级别) --}}
                            @can('permission', '2.3')
                                <li><a href="{{url('/createProject/checkProjectSchool')}}" class="">题目审查(学校)</a></li>
                            @endcan
                            {{-- 2.5是教师查看选题申请的权限 --}}
                            @can('permission', '2.5')
                                <li><a href="{{url('/createProject/ManageProjects')}}" class="">课题申请状态</a></li>
                            @endcan
                        </ul>
                    </div>
                </li>
                <li><a href="elements.html" class=""><i class="lnr lnr-code"></i> <span>Elements</span></a></li>
                <li><a href="charts.html" class=""><i class="lnr lnr-chart-bars"></i> <span>Charts</span></a></li>
                <li><a href="panels.html" class=""><i class="lnr lnr-cog"></i> <span>Panels</span></a></li>
                <li><a href="notifications.html" class=""><i class="lnr lnr-alarm"></i> <span>Notifications</span></a></li>
                <li>
                    <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Pages</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages" class="collapse ">
                        <ul class="nav">
                            <li><a href="page-profile.html" class="">Profile</a></li>
                            <li><a href="page-login.html" class="">Login</a></li>
                            <li><a href="page-lockscreen.html" class="">Lockscreen</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="tables.html" class=""><i class="lnr lnr-dice"></i> <span>Tables</span></a></li>
                <li><a href="typography.html" class=""><i class="lnr lnr-text-format"></i> <span>Typography</span></a></li>
                <li><a href="icons.html" class=""><i class="lnr lnr-linearicons"></i> <span>Icons</span></a></li>
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->