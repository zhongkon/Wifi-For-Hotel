<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>{{ config('app.name', 'Laravel') }} </title>
		<meta name="description" content="Wifi Internet Controller">
        <meta name="author" content="Web Development - Zhong">
        <meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Favicon -->
		<link rel="shortcut icon" href="/assets/images/favicon.ico">

		<!-- Switchery css -->
		<link href="/assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
		
		<!-- Bootstrap CSS -->
		<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		<!-- Font Awesome CSS -->
		<link href="/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		
		<!-- Custom CSS -->
		<link href="/assets/css/style.css" rel="stylesheet" type="text/css" />	
		
		<!-- BEGIN CSS for this page -->
        @yield('cssaddon')
		<!-- END CSS for this page -->
				
</head>

<body class="adminbody-void">

<div id="main" class="enlarged forced">

	<!-- top bar navigation -->
	<div class="headerbar">

		<!-- LOGO -->
        <div class="headerbar-left">
			<a href="/dashboard" class="logo"><img alt="logo" src="/assets/images/logo.png" /> <span>Admin</span></a>
        </div>

        <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">

						<li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fa fa-fw fa-question-circle"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5><small>Help and Support</small></h5>
                                </div>

                                <!-- item-->
                                <a target="_blank" href="https://www.pikeadmin.com" class="dropdown-item notify-item">                                    
                                    <p class="notify-details ml-0">
                                        <b>Do you want custom development to integrate this theme?</b>
                                        <span>Contact Us</span>
                                    </p>
                                </a>

                                <!-- item-->
                                <a target="_blank" href="https://www.pikeadmin.com/pike-admin-pro" class="dropdown-item notify-item">                                    
                                    <p class="notify-details ml-0">
                                        <b>Do you want PHP version of the theme that save dozens of hours of work?</b>
                                        <span>Try Pike Admin PRO</span>
                                    </p>
                                </a>                               

                                <!-- All-->
                                <a title="Clcik to visit Pike Admin Website" target="_blank" href="https://www.pikeadmin.com" class="dropdown-item notify-item notify-all">
                                    <i class="fa fa-link"></i> Visit Pike Admin Website
                                </a>

                            </div>
                        </li>
						
                        <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fa fa-fw fa-envelope-o"></i><span class="notif-bullet"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5><small><span class="label label-danger pull-xs-right">12</span>Contact Messages</small></h5>
                                </div>

                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">                                    
                                    <p class="notify-details ml-0">
                                        <b>Jokn Doe</b>
                                        <span>New message received</span>
                                        <small class="text-muted">2 minutes ago</small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">                                    
                                    <p class="notify-details ml-0">
                                        <b>Michael Jackson</b>
                                        <span>New message received</span>
                                        <small class="text-muted">15 minutes ago</small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">                                    
                                    <p class="notify-details ml-0">
                                        <b>Foxy Johnes</b>
                                        <span>New message received</span>
                                        <small class="text-muted">Yesterday, 13:30</small>
                                    </p>
                                </a>

                                <!-- All-->
                                <a href="#" class="dropdown-item notify-item notify-all">
                                    View All
                                </a>

                            </div>
                        </li>
                        
						<li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fa fa-fw fa-bell-o"></i><span class="notif-bullet"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg">
								<!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5><small><span class="label label-danger pull-xs-right">5</span>Allerts</small></h5>
                                </div>
								
                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-faded">
                                        <img src="/assets/images/avatars/avatar2.png" alt="img" class="rounded-circle img-fluid">
                                    </div>
                                    <p class="notify-details">
                                        <b>John Doe</b>
                                        <span>User registration</span>
                                        <small class="text-muted">3 minutes ago</small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-faded">
                                        <img src="/assets/images/avatars/avatar3.png" alt="img" class="rounded-circle img-fluid">
                                    </div>
                                    <p class="notify-details">
                                        <b>Michael Cox</b>
                                        <span>Task 2 completed</span>
                                        <small class="text-muted">12 minutes ago</small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-faded">
                                        <img src="/assets/images/avatars/avatar4.png" alt="img" class="rounded-circle img-fluid">
                                    </div>
                                    <p class="notify-details">
                                        <b>Michelle Dolores</b>
                                        <span>New job completed</span>
                                        <small class="text-muted">35 minutes ago</small>
                                    </p>
                                </a>

                                <!-- All-->
                                <a href="#" class="dropdown-item notify-item notify-all">
                                    View All Allerts
                                </a>

                            </div>
                        </li>

                        <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="/assets/images/avatars/admin.png" alt="Profile image" class="avatar-rounded">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>Hello, {{ Auth::user()->name }} </small> </h5>
                                </div>

                                <!-- item-->
                                <a href="pro-profile.html" class="dropdown-item notify-item">
                                    <i class="fa fa-user"></i> <span>Profile</span>
                                </a>

                                <!-- item-->
                                <a href="{{ route('logout') }}" class="dropdown-item notify-item" 
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">                                       
                                    <i class="fa fa-power-off"></i> <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                </form>
								<!-- item-->

                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left">
								<i class="fa fa-fw fa-bars"></i>
                            </button>
                        </li>                        
                    </ul>

        </nav>

	</div>
	<!-- End Navigation -->
	
 
	<!-- Left Sidebar -->
	<div class="left main-sidebar">
	
		<div class="sidebar-inner leftscroll">

			<div id="sidebar-menu">
        

				<ul>
	
						<li class="submenu">
							<a href="/dashboard" class="{{ (request()->is('dashboard')) ? 'active' : '' }}"><i class="fa fa-fw fa-bars"></i><span> Dashboard </span> </a>
						</li>
	
						<li class="submenu">
							<a href="/resetpassword" class="{{ (request()->is('resetpassword')) ? 'active' : '' }}"><i class="fa fa-fw fa-user-o"></i><span> Reset Wifi Password </span> </a>
						</li>
						
	
						<li class="submenu">
							<a href="/audit-trail" class="{{ (request()->is('audit-trail')) ? 'active' : '' }}"><i class="fa fa-fw fa-history"></i><span> Audit Trail </span> </a>
						</li>
	
						<li class="submenu">
							<a href="/what-wrong" class="{{ (request()->is('what-wrong')) ? 'active' : '' }}"><i class="fa fa-fw fa-question-circle"></i><span> What's wrong? </span> </a>
						</li>
	
						<li class="submenu">
							<a href="/user-online" class="{{ (request()->is('user-online')) ? 'active' : '' }}"><i class="fa fa-fw fa-user"></i><span>User Online </span> </a>
						</li>
	
						<li class="submenu">
							<a href="#" class="{{ (request()->is('admin*')) ? 'active' : '' }}"><i class="fa fa-fw fa-cogs"></i> <span>Admin Menu & Config</span> <span class="menu-arrow"></span></a>
								<ul class="list-unstyled">
                                    <li class="{{ (request()->is('admin/wifi-function')) ? 'active' : '' }}"><a href="/admin/wifi-function">Function Wifi Services </a></li>
                                    <li class="{{ (request()->is('admin/mac-auth')) ? 'active' : '' }}"><a href="/admin/mac-auth"> MAC Address Auth</a></li>
                                    <li class="{{ (request()->is('admin/group-config')) ? 'active' : '' }}"><a href="/admin/group-config" >Wifi Group Config</a></li>
                                    <li class="{{ (request()->is('admin/guest-config')) ? 'active' : '' }}"><a href="/admin/guest-config" >Guest Wifi Config</a></li>
									<li class="{{ (request()->is('admin/users')) ? 'active' : '' }}"><a href="/admin/users" >User Manager</a></li>
								</ul>
						</li>
							<!--				
						<li class="submenu">
							<a href="#" class=""><i class="fa fa-fw fa-tv"></i> <span> Interface </span> <span class="menu-arrow"></span></a>
								<ul class="list-unstyled" style="display: none;">
									<li><a href="ui-alerts.html">Alerts</a></li>
									<li><a href="ui-buttons.html">Buttons</a></li>
									<li><a href="ui-cards.html">Cards</a></li>
									<li><a href="ui-carousel.html">Carousel</a></li>
									<li><a href="ui-collapse.html">Collapse</a></li>
									<li><a href="ui-icons.html">Icons</a></li>
									<li><a href="ui-modals.html">Modals</a></li>
									<li><a href="ui-tooltips.html">Tooltips and Popovers</a></li>
								</ul>
						</li>-->
						
				</ul>
	
				<div class="clearfix"></div>
	
				</div>
        
			<div class="clearfix"></div>

		</div>

	</div>
	<!-- End Sidebar -->


    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">

					
							<div class="row">
									<div class="col-xl-12">
											<div class="breadcrumb-holder">
													<h1 class="main-title float-left">@yield('title')</h1>
													<ol class="breadcrumb float-right">
														<li class="breadcrumb-item">Home</li>
														<li class="breadcrumb-item active">@yield('title')</li>
													</ol>
													<div class="clearfix"></div>
											</div>
									</div>
							</div>
							<!-- end row -->

							
							<div class="row">
									<div class="col-xl-12">
									@yield('content')
									</div>
							</div>



            </div>
			<!-- END container-fluid -->

		</div>
		<!-- END content -->

    </div>
	<!-- END content-page -->
    
	<footer class="footer">
		<span class="text-right">
		Copyright <a target="_blank" href="#">Zhong</a>
		</span>
		<span class="float-right">
		Free Bootstrap 4 Admin Theme <a target="_blank" href="https://www.pikeadmin.com"><b>Pike Admin</b></a>
		</span>
	</footer>

</div>
<!-- END main -->

<script src="/assets/js/modernizr.min.js"></script>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/moment.min.js"></script>

<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>

<script src="/assets/js/detect.js"></script>
<script src="/assets/js/fastclick.js"></script>
<script src="/assets/js/jquery.blockUI.js"></script>
<script src="/assets/js/jquery.nicescroll.js"></script>
<script src="/assets/js/jquery.scrollTo.min.js"></script>
<script src="/assets/plugins/switchery/switchery.min.js"></script>

<!-- App js -->
<script src="/assets/js/pikeadmin.js"></script>

<!-- BEGIN Java Script for this page -->
@yield('jsaddon')
<!-- END Java Script for this page -->

</body>
</html>