<?php
  session_start();

  // Check if the session variable exists
	if (!isset($_SESSION['user_ID'])) {
		// Redirect to the login page
		header("Location: login.html");
		exit();
	}
	else {
		
		include("assets/php/connection.php");

		if (isset($_GET['studyhub_ID'])) {
			$studyhub_ID = $_GET['studyhub_ID'];
		}

	}
  
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content=""/>
		<meta name="author" content=""/>
		<title>Create Study Session</title>
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

			<!--Start sidebar-wrapper-->
			<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
				<div class="brand-logo">
					<a href="index.html">
						<img src="assets/images/collabHub-icon.png" class="logo-icon" alt="logo icon">
						<h5 class="logo-text">CollabHub</h5>
					</a>
				</div>
				
				<ul class="sidebar-menu do-nicescrol">
					<li class="sidebar-header">MAIN NAVIGATION</li>
					<li>
						<a href="index.html">
							<i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
						</a>
					</li>


					<li>
						<a href="myApplication.php">
							<i class="zmdi zmdi-format-list-bulleted"></i> <span>Open Application</span>
						</a>
					</li>

					<li>
						<a href="myStudyHub.php">
							<i class="zmdi zmdi-grid"></i> <span>StudyHub</span>
						</a>
					</li>

					<li>
						<a href="<?php
							// Check if the status is set in the session
							if (isset($_SESSION["mentorshipStatus"])) {
								// Get the status value
								$status = $_SESSION["mentorshipStatus"];
								
								// Generate the dynamic anchor link
								$link = "mentorship_" . strtolower($status) . ".php";
								
								// Output the link
								echo $link;
							} else {
								// Fallback link if the status is not set
					
								echo "mentorship.php"; // You can change this to the default link
							}
						?>">
							<i class="zmdi zmdi-male-female"></i> <span>Mentor Mentee</span>
							<small class="badge float-right badge-light">New</small>
						</a>
					</li>

					
					<li>
						<a href="peerReview.php">
							<i class="zmdi zmdi-mood-bad"></i> <span>Peer Review</span>
							<small class="badge float-right badge-light">New</small>
						</a>
					</li>
				</ul>
			</div>
			
			<header class="topbar-nav">
				<nav class="navbar navbar-expand fixed-top">
					<ul class="navbar-nav mr-auto align-items-center">
						<li class="nav-item">
							<a class="nav-link toggle-menu" href="javascript:void();">
								<i class="icon-menu menu-icon"></i>
							</a>
						</li>
						<li class="nav-item">
							<form class="search-bar">
								<input type="text" class="form-control" placeholder="Enter keywords">
								<a href="javascript:void();"><i class="icon-magnifier"></i></a>
							</form>
						</li>
					</ul>
      
					<ul class="navbar-nav align-items-center right-nav-link">
						<li class="nav-item dropdown-lg">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
								<i class="fa fa-envelope-open-o"></i>
							</a>
						</li>
						<li class="nav-item language">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
								<i class="fa fa-bell-o position-relative" style="font-size: 24px;">
									<!-- No span for notification count here -->
								</i>
							</a>


							<ul id="notificationList" class="dropdown-menu dropdown-menu-right">
									
									
							</ul>
						</li>
						<li class="nav-item language">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();"><i class="fa fa-flag"></i></a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
								<li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
								<li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
								<li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
							</ul>
						</li>
						<li class="nav-item">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
								<span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li class="dropdown-item user-details">
									<a href="myProfile.php">
										<div class="media">
											<div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
											<div class="media-body">
												<h6 class="mt-2 user-title"><?php echo $_SESSION["name"];?></h6>
												<p class="user-subtitle"><?php echo $_SESSION["email"];?></p>
											</div>
										</div>
									</a>
								</li>
							
								<li class="dropdown-divider"></li>
								<li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
								<li class="dropdown-divider"></li>
								<li class="dropdown-item"><a href="myProfile.php"><i class="icon-wallet mr-2"></i> Account</li>
								<li class="dropdown-divider"></li>
								<li class="dropdown-item"><a href="editProfile.php"><i class="icon-settings mr-2"></i> Setting</a></li>

								<li class="dropdown-divider"></li>
								<a href = "assets/php/logout.php">
									<li class="dropdown-item">
										
										<i class="icon-power mr-2"></i> Logout
										
									</li>
								</a>
							</ul>
						</li> 	
					</ul>
				</nav>
			</header>


			<div class="clearfix"></div>
    
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row mt-3">
						<div class="col-lg-6">
							<div class="card">
								<div class="card-body">
									<div class="card-title">Create Study Session</div>
									<hr>	
									<!--Group Application - Form-->
									<form action="assets/php/process_createStudySession.php" method="POST">

										<input type="hidden" name="studyhub_ID" value="<?php echo $studyhub_ID; ?>">

										<!--Session Name-->
										<div class="form-group">
											<label for="input-1">Session Name:</label>
											<input type="text" class="form-control" id="input-1" name="studysession_name" placeholder="Session name">
										</div>

										<!--Session Date-->
										<div class="form-group">
											<label for="input-2">Session Date:</label>
											<input type="date" class="form-control" id="input-2" name ="studysession_date" placeholder="Session date">
										</div>

										<!--Session Time-->
										<div class="form-group">
											<label for="input-2">Session Time:</label>
											<input type="time" class="form-control" id="input-3" name ="studysession_time" placeholder="Session time">
										</div>

										<!--Session Mode-->
										<div class="form-group">
											<label for="input-3">Session Mode:</label>

											<br> 

											<input type="radio" id="option1" name="studysession_mode" value="Online">
											<label for="option1">Online</label>
											&nbsp;&nbsp;
											<input type="radio" id="option2" name="studysession_mode" value="Physical">
											<label for="option2">Physical</label>									  
										</div>

										<!--Session Link-->
										<div class="form-group">
											<label for="input-2">Session Link:</label>
											<input type="text" class="form-control" id="input-4" name ="studysession_link" placeholder="Session link">
										</div>

										<!--Session Note-->
										<div class="form-group">
											<label for="input-1">Note:</label>
											<input type="text" class="form-control" id="input-5" name="note" placeholder="Note">
										</div>

										<!--Submit Button - Create Session-->
										<center><button type="submit" class="btn btn-light px-5"><i class=""></i>Create Session</button></center>
										

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
		<script src="assets/js/notification.js"></script>
    
		<script>
			displayNotifications();
		</script>
		
	</body>
</html>

