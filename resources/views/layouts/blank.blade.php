<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>Pike Admin - Free Bootstrap 4 Admin Template</title>
		<meta name="description" content="Free Bootstrap 4 Admin Theme | Pike Admin">
		<meta name="author" content="Pike Web Development - https://www.pikephp.com">

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
		
		<script src="/assets/js/modernizr.min.js"></script>
		<script src="/assets/js/jquery.min.js"></script>
		<script src="/assets/js/moment.min.js"></script>

		<!-- BEGIN CSS for this page -->
        @yield('cssaddon')
		<!-- END CSS for this page -->
</head>

<body>

<div id="main">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container" style ="padding-top: 20px;">
			
			<div class="row">
			

		<!-- Content -->
		@yield('content')
		<!-- ./ content -->

		</div>														
						</div><!-- end card-->					
                    </div>
					
					
			</div>





            </div>
			<!-- END container-fluid -->

		</div>
		<!-- END content -->

 
	<!-- END content-page -->
    
</div>
<!-- END main -->	

	<!-- ./ container -->
	@yield('jsaddon')
	
	
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
<script src="/assets/plugins/parsleyjs/parsley.min.js"></script>
<script>
  $('#form').parsley();
</script>
<!-- END Java Script for this page -->
</body>
</html>