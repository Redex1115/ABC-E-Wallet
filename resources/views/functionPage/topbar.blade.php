<link href="{{ asset('css/topbar.css') }}" rel="stylesheet">
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">
                <!-- Logo Icon -->
                <i class="fa fa-money fa-2x" style="color: black;"></i>
                <!-- Logo text -->
                <span style="display: none; color: black; padding-left: 5px;">Admin BackEnd</span>
            </a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <!-- This is  -->
                <li class="nav-item hidden-sm-up"> <a class="nav-link nav-toggler waves-effect waves-light"
                        href="javascript:void(0)"><i class="ti-menu fa fa-bars" style="color: black;"></i></a></li>
                <!-- Search -->
                <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-search" style="color: black;"></i></a>
                    <form class="app-search">
                        <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="fa fa-times" style="color: black;"></i></a>
                    </form>
                </li>
            </ul>
            <ul class="navbar-nav my-lg-0">
                <!-- User profile -->
                <li class="nav-item">
                    <a class="nav-link text-muted waves-effect waves-dark" href="{{ url('admin/profile')}} aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" style="color: green;"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>