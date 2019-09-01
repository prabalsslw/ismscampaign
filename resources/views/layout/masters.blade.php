<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	
    @yield('head')
</head>
<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="dashboard" class="site_title"><i class="fa fa-dashboard"></i> <span>SSL CARE</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <!-- <div class="profile_pic">
                            <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                        </div> -->
                        <!-- <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>Anthony Fernando</h2>
                        </div> -->
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>Tools</h3>
                            <ul class="nav side-menu">
                                <li><a href="dashboard"><i class="fa fa-home"></i> Home </a></li>
                                @foreach ($topbar as $top)      <!-- For Top Menue -->
                                    @if($top == 1)                      <!-- Top -->
                                        <li><a><i class="fa fa-paper-plane-o"></i> PUSH PULL <span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu" style="display: none;">
                                                @foreach ($leftbarpushpull as $leftpushpull)        <!-- For Left Menue(PUSH PULL)-->
                                                    @if($leftpushpull == 1)
                                                        <li><a href="#">Customer Care</a></li>
                                                    @elseif($leftpushpull == 2)
                                                        <li><a href="#">Hot Key Wise</a></li>
                                                    @elseif($leftpushpull == 3)
                                                        <li><a href="#">Short Code Wise</a></li>
                                                    @elseif($leftpushpull == 4)
                                                        <li><a href="#">Invoice</a></li>
                                                    @elseif($leftpushpull == 5)
                                                        <li><a href="#">Telco Wise</a></li>
                                                    @elseif($leftpushpull == 6)
                                                        <li><a href="#">Subscription</a></li>
                                                    @elseif($leftpushpull == 7)
                                                        <li><a href="#">Employees</a></li>
                                                    @elseif($leftpushpull == 8)
                                                        <li><a href="#">Employees</a></li>
                                                    @elseif($leftpushpull == 9)
                                                        <li><a href="#">Employees</a></li> 
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @elseif($top == 2)
                                    @elseif($top == 3)
                                        <li><a><i class="fa fa-suitcase"></i> BULK <span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu" style="display: none">
                                                @foreach ($leftbarbulk as $leftbulk)        <!-- For Left Menue(BULK)-->
                                                    @if($leftbulk == 1)
                                                        <li><a href="#">Customer Care</a></li>
                                                    @elseif($leftbulk == 2)
                                                        <li><a href="#">Out Box Info</a></li>
                                                    @elseif($leftbulk == 3)
                                                        <li><a href="#">Queue Report</a></li>
                                                    @elseif($leftbulk == 4)
                                                        <li><a href="#">Telco Balance</a></li>
                                                    @elseif($leftbulk == 5)
                                                        <li><a href="#">Invoice</a></li>
                                                    @elseif($leftbulk == 6)
                                                        <li><a href="#">Upload</a></li>
                                                    @elseif($leftbulk == 7)
                                                        <li><a href="#">Outgoing SMS</a></li>
                                                    @elseif($leftbulk == 8)
                                                        <li><a href="#">Delivery Report</a></li>
                                                    @elseif($leftbulk == 9)
                                                        <li><a href="#">Owner Report</a></li>
                                                    @elseif($leftbulk == 10)
                                                        <li><a href="#">Fail Report</a></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @elseif($top == 4)
                                    @elseif($top == 5)
                                        <li><a><i class="fa fa-support"></i> SUPPORT <span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu" style="display: none">
                                                <li><a href="#">PUSH Normal</a></li>
                                                <li><a href="#">PUSH Scheduled</a></li>
                                                <li><a href="#">PUSH SMS Out Telco</a></li>
                                                <li><a href="#">PUSHSMS Summary</a></li>
                                                <li><a href="#">HOTKEY Summary</a></li>
                                                <li><a href="#">SHORTCODE Summary</a></li>
                                                <li><a href="#">DND Search</a></li>
                                            </ul>
                                        </li>
                                    @elseif($top == 6)
                                        <li><a><i class="fa fa-user"></i> ADMIN <span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu" style="display: none">
                                                @foreach ($leftbaradmin as $leftadmin)        <!-- For Left Menue(BULK)-->
                                                    @if($leftadmin == 1)
                                                        <li><a href="#">Users</a></li>
                                                    @elseif($leftadmin == 2)
                                                        <li><a href="#">Stakeholders</a></li>
                                                    @elseif($leftadmin == 3)
                                                        <li><a href="#">Shortcode & Hotkey</a></li>
                                                    @elseif($leftadmin == 4)
                                                        <li><a href="#">Companys</a></li>
                                                    @elseif($leftadmin == 5)
                                                        <li><a href="#">Balance Assign</a></li>
                                                    @elseif($leftadmin == 6)
                                                        <li><a href="#">Employees</a></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @elseif($top == 7)
                                        <li><a><i class="fa fa-file-text"></i> SMS <span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu" style="display: none">
                                                @foreach ($leftbarsms as $leftsms)        <!-- For Left Menue(SMS)-->
                                                    @if($leftsms['left_menu_id'] == 1)
                                                        <li><a href="#">SMS Status</a></li>
                                                    @elseif($leftsms['left_menu_id'] == 2)
                                                        <li><a href="#">Send SMS</a></li>
                                                    @elseif($leftsms['left_menu_id'] == 3)
                                                        <li><a href="#">Prepare SMS</a></li>
                                                    @elseif($leftsms['left_menu_id'] == 4)
                                                        <li><a href="#">Authenticate  SMS</a></li>
                                                    @elseif($leftsms['left_menu_id'] == 5)
                                                        <li><a href="#">SMS Templates</a></li>
                                                    @elseif($leftsms['left_menu_id'] == 6)
                                                        <li><a href="#">Contact List</a></li>
                                                    @elseif($leftsms['left_menu_id'] == 7)
                                                        <li><a href="#">Contact Category</a></li>
                                                    @elseif($leftsms['left_menu_id'] == 8)
                                                        <li><a href="#">SMS Status Test</a></li>
                                                    @elseif($leftsms['left_menu_id'] == 9)
                                                        <li><a href="#">Bangla Converter</a></li>
                                                    @elseif($leftsms['left_menu_id'] == 10)
                                                        <li><a href="#">Regular SMS</a></li>
                                                    @elseif($leftsms['left_menu_id'] == 11)
                                                        <li><a href="#">Doctors Wish</a></li>
                                                    @elseif($leftsms['left_menu_id'] == 12)
                                                        <li><a href="#">Contact Approval</a></li>
                                                    @elseif($leftsms['left_menu_id'] == 13)
                                                        <li><a href="campaign">Campaign</a></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a href="logout" data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <div class="nav toggle pull-right">
                            <a class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"><i class="fa fa-angle-double-down"></i></a>
                        </div>

                        <div class="collapse navbar-collapse" id="myNavbar">
	                        <ul class="nav navbar-nav navbar-left">
	                        	<li class="">
	                                <a href="dashboard" class="user-profile" aria-expanded="false">
	                                    <span class=" fa fa-home"></span> Home
	                                </a>
	                            </li>
	                        </ul>
                       </div>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">

                <!-- top tiles -->
                <div class="row tile_count">
                    @yield('header')
                </div>
                <!-- /top tiles -->

                <div class="row">
                	@yield('content')
                </div>

                <!-- footer content -->

                <footer>
                    @yield('footer')
                </footer>
                <!-- /footer content -->
            </div>
            <!-- /page content -->

        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
       	@yield('notification')
    </div>

    @yield('jscript')
</body>

</html>
