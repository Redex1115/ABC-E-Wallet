<link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
<aside class="left-sidebar">
    <div class="d-flex no-block nav-text-box align-items-center">
        <span>Admin BackEnd</span>
        <a class="waves-effect waves-dark ml-auto hidden-sm-down" href="javascript:void(0)"><i class="ti-menus fa fa-bars" style="color: grey;"></i></a>
        <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i class="ti-close fa fa-times"></i></a>
    </div>
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar ps ps--theme_default" data-ps-id="99fc981b-8e50-5321-9274-487b83d68f64">
        <!-- Sidebar navigation-->            
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="selected"> <a class="waves-effect waves-dark active" href="{{url('admin/dashboard')}}" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a></li>
                <li><a class="waves-effect waves-dark" href="{{url('admin/wallet')}}" aria-expanded="false"><i class="fa fa-dollar"></i><span class="hide-menu"></span>Wallet</a></li>
                <li><a class="waves-effect waves-dark" href="{{url('admin/table')}}" aria-expanded="false"><i class="fa fa-table"></i><span class="hide-menu"></span>Table</a></li>
                <li><a class="waves-effect waves-dark" href="{{url('admin/transactionHistory')}}" aria-expanded="false"><i class="fa fa-history" aria-hidden="true"></i><span class="hide-menu"></span>Transaction History</a></li>
                <li><a class="waves-effect waves-dark" href="{{url('admin/test')}}" aria-expanded="false"><i class="fa fa-history" aria-hidden="true"></i><span class="hide-menu"></span>Test</a></li>
                <li><a class="waves-effect waves-dark" href="{{url('admin/logout')}}" aria-expanded="false"><i class="fa fa-reply"></i><span class="hide-menu"></span>Logout</a></li>
            </ul>
        </nav>
    <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</aside>