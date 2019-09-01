<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	
    @yield('head')

    <link rel="stylesheet" href="themes/offline-theme-chrome.css" />
    <link rel="stylesheet" href="themes/offline-language-english.css" />
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
                                    @if($top == 7)
                                        <li><a><i class="fa fa-file-text"></i> SMS <span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu" style="display: none">
                                                @foreach ($leftbarsms as $leftsms)        <!-- For Left Menue(SMS)-->
                                                    @if($leftsms['left_menu_id'] == 1)
                                                        <li><a href="smsstatus">SMS Status</a></li>
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
                        <!-- <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>-->

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
	                        <!-- <ul class="nav navbar-nav navbar-left">
	                        	<li class="">
	                                <a href="dashboard" class="user-profile" aria-expanded="false">
	                                    <span class=" fa fa-home"></span> Home
	                                </a>
	                            </li>
	                        </ul> -->
                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="images/user.png" alt="">{{session('user_id')}}
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                        <li><a href="logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                        </li>
                                    </ul>
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

    <script src="js/offline.min.js"></script>
    <script>
        var run = function(){
          var req = new XMLHttpRequest();
          req.timeout = 5000;
          req.open('GET', 'http://192.168.161.85/ismscampaign/public/', true);
          req.send();
        }

        setInterval(run, 3000);
    </script>
</body>

</html>
