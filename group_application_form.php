<?php
  session_start();
  
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content=""/>
		<meta name="author" content=""/>
		<title>Member Application Form</title>
		<!-- loader-->
		<link href="assets/css/pace.min.css" rel="stylesheet"/>
		<script src="assets/js/pace.min.js"></script>
		<!--favicon-->
		<link rel="icon" href="assets/images/CB-favi.ico" type="image/x-icon">
		<!-- simplebar CSS-->
		<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
		<!-- Bootstrap core CSS-->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
		<!-- animate CSS-->
		<link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
		<!-- Icons CSS-->
		<link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
		<!-- Sidebar CSS-->
		<link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
		<!-- Custom Style-->
		<link href="assets/css/app-style.css" rel="stylesheet"/>
		<style>
			.img-circle {
				border-radius: 50%;
				object-fit: cover; /* Maintain image aspect ratio */
				/* Add any additional styles or adjustments as needed */
			}
		</style>
	</head>

	<body class="bg-theme bg-theme9">
		<div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
		<div id="wrapper">
			<?php include_once('sidebar.php'); ?>
			<?php include_once('topbar.php'); ?>

			<div class="clearfix"></div>
    
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row mt-3">
						<div class="col-lg-6">
							<div class="card">
								<div class="card-body">
									<div class="card-title">Group Member Application Form</div>
									<hr>	
									<!--Group Application - Form-->
									<form action="assets/php/add-group-app.php" method="POST">

										<!--Department Name-->
										<div class="form-group">
											<label for="input-1">Department:</label>
											<select class="form-control" name="department_name" id="input-1">
												<option value="Department of Artificial Intelligent">Department of Artificial Intelligent</option>
												<option value="Department of Computer System and Network">Department of Computer System and Network</option>
												<option value="Department of Information System">Department of Information System</option>
												<option value="Department of Software Engineering">Department of Software Engineering</option>
												<option value="Department of Multimedia Computing">Department of Multimedia Computing</option>
												<option value="Department of Data Science">Department of Data Science </option>
											</select>
											<!---<input type="text" class="form-control" id="input-1" placeholder="Enter Your Name">--->
										</div>

										<!--Course Name-->
										<div class="form-group">
											<label for="input-2">Course:</label>
											<input type="text" class="form-control" id="input-2" name ="course_name" placeholder="Enter the course name">
										</div>

										<!--Project Name-->
										<div class="form-group">
											<label for="input-3">Project Name:</label>
											<input type="text" class="form-control" id="input-3" name ="project_name" placeholder="Enter your project name">
										</div>

										<!--Project Description-->
										<div class="form-group">
											<label for="input-4">Project Description:</label>
											<input type="text" class="form-control" id="input-4" name ="project_description" placeholder="Enter project description">
										</div>

										<!--Skill Wanted-->
										<div class="form-group">
											<label for="input-5">Skills Wanted:</label>
											<input type="text" class="form-control" id="input-5" name ="skill_needed" placeholder="Enter the skill sets you wanted">
										</div>

										<!--Notes-->
										<div class="form-group">
											<label for="input-6">Notes:</label>
											<input type="text" class="form-control" id="input-6" name ="notes" placeholder="Enter extra notes if there is any">
										</div>
              
										<!--Submit Button - Create Application-->
										<div class="form-group">
											<center><button type="submit" class="btn btn-light px-5"><i class=""></i> Create Application</button></center>
										</div>

									</form>
								</div>
							</div>
						</div>
						<div class="overlay toggle-menu"></div>
					</div>
				</div>
			</div>
			<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
		
			<footer class="footer">
				<div class="container">
					<div class="text-center">
					</div>
				</div>
			</footer>
			<div class="right-sidebar">
				<div class="switcher-icon">
					<i class="zmdi zmdi-settings zmdi-hc-spin"></i>
				</div>
				<div class="right-sidebar-content">

					<p class="mb-0">Gaussion Texture</p>
					<hr>
			
					<ul class="switcher">
						<li id="theme1"></li>
						<li id="theme2"></li>
						<li id="theme3"></li>
						<li id="theme4"></li>
						<li id="theme5"></li>
						<li id="theme6"></li>
					</ul>

					<p class="mb-0">Gradient Background</p>
					<hr>
				
					<ul class="switcher">
						<li id="theme7"></li>
						<li id="theme8"></li>
						<li id="theme9"></li>
						<li id="theme10"></li>
						<li id="theme11"></li>
						<li id="theme12"></li>
						<li id="theme13"></li>
						<li id="theme14"></li>
						<li id="theme15"></li>
					</ul>
			
				</div>
			</div>
		</div>


		<!-- Bootstrap core JavaScript-->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
    
		<!-- simplebar js -->
		<script src="assets/plugins/simplebar/js/simplebar.js"></script>
		<!-- sidebar-menu js -->
		<script src="assets/js/sidebar-menu.js"></script>
    
		<!-- Custom scripts -->
		<script src="assets/js/app-script.js"></script>
		<script src="assets/js/inviteMM.js"></script>
    
		<script>
			displayNotifications();
		</script>
	</body>
</html>

