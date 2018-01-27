<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                {{--概览--}}
                <li><a href="{{url('/student')}}" class="{{Request::getPathInfo()=="/student"?"active":""}}"><i class="lnr lnr-home"></i><span>首页</span></a></li>
                {{--2.4是选题权限--}}
                @can('permission', '2.4')
                    <li><a href="{{url('selectProject')}}" class="{{Request::getPathInfo()=="/selectProject"?"active":""}}"><i class="lnr lnr-inbox"></i> <span>选择课题</span></a></li>
                @endcan
                <li><a href={{ url('/student/uploadThesis') }} class=""><i class="lnr lnr-file-empty"></i> <span>上传论文</span></a></li>
                <li>
                    <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-code"></i> <span>毕业设计步骤</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages" class="collapse ">
                        <ul class="nav">
                            <li><a href="{{ url('/open') }}" class="">开题报告编写</a></li>
                            <li><a href="{{ url('/my_opening') }}" class="">我的开题报告</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->