<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href={{ url('/student') }} class=""><i class="lnr lnr-home"></i> <span>首页</span></a></li>
                <li><a href={{ url('/student/uploadThesis') }} class=""><i class="lnr lnr-file-empty"></i> <span>上传论文</span></a></li>
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
            </ul>
        </nav>
    </div>
</div>
<!-- END LEFT SIDEBAR -->