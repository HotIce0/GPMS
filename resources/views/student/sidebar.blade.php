<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                {{--概览--}}
                <li><a href="{{url('/student')}}" class="{{Request::getPathInfo()=="/student"?"active":""}}"><i class="lnr lnr-home"></i><span>概览</span></a></li>
                {{--2.4是选题权限--}}
                @can('permission', '2.4')
                    <li><a href="{{url('selectProject')}}" class="{{Request::getPathInfo()=="/selectProject"?"active":""}}"><i class="lnr lnr-inbox"></i> <span>选择课题</span></a></li>
                @endcan
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->