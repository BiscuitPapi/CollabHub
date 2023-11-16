<?php
	session_start();
	// Check if the session variable exists
	if (!isset($_SESSION['user_ID'])) {
		// Redirect to the login page
		header("Location: login.php");
		exit();
	}
	else {
		
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content=""/>
		<meta name="author" content=""/>
		<title>Edit Experience</title>
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
			.badge-container {
			display: flex;
			flex-wrap: wrap;
			gap: 5px;
		}

			.badge-wrapper {
				display: inline-block;
			}

			.delete-button {
				color: #00000;
				font-weight: bold;
				font-size: 18px; /* Adjust the font size to make the X button bigger */
				margin-left: 5px; /* Add some spacing between the input field and the X button */
				padding: 4px 8px; 
				text-decoration: none;
				margin-left: 5px; /* Add some spacing between the input field and the X button */
				margin-right: -10px; /* Move the X button towards the right edge of the badge */
			}
			.img-circle {
				border-radius: 50%;
				object-fit: cover; /* Maintain image aspect ratio */
				/* Add any additional styles or adjustments as needed */
			}

		</style>
	</head>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<body class="bg-theme bg-theme9">
		<!-- start loader -->
		<div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
		<!-- end loader -->

		<!-- Start wrapper-->
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
			<!--End sidebar-wrapper-->

			<!--Start topbar header-->
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
							<i class="fa fa-envelope-open-o"></i></a>
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
								<span class="user-profile"><img class="img-circle" src="assets/php/image.php?picture=profile&user_ID=<?php echo $_SESSION["user_ID"];?> " alt="profile-image">	</span>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li class="dropdown-item user-details">
									<a href="myProfile.php">
										<div class="media">
											<div class="avatar"><img class="align-self-start mr-3" src="assets/php/image.php?picture=profile&user_ID=<?php echo $_SESSION["user_ID"];?> " alt="profile-image">	</div>
											<div class="media-body">
												<h6 class="mt-2 user-title"><?php echo $_SESSION['name'];?></h6>
												<p class="user-subtitle"><?php echo $_SESSION['email'];?></p>
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
			<!--End topbar header-->

			<div class="clearfix"></div>
		
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="card mt-3">
						
					</div>  
					
					<div class="row">
						<div class="col-12 col-lg-8 col-xl">
							<div class="card">
								<div class="card-body">
									<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
										<li class="nav-item">
											<a href="javascript:void();" data-target="#experience" data-toggle="pill" class="nav-link"><i class="zmdi zmdi-assignment-o"></i> <span class="hidden-xs">Experience</span></a>
										</li>
									</ul>
									<?php 
										include("assets/php/connection.php");

										$exp_ID = $_GET['exp_ID'];
										
										$sql = "SELECT * FROM experience WHERE exp_ID ='$exp_ID'";

										// execute the query
										$result = mysqli_query($connection, $sql);

										// check if the query returned any rows
										if (mysqli_num_rows($result) > 0) {

											$res = $result->fetch_assoc();
											$_SESSION['type'] = $res['type'];
											$_SESSION['position'] = $res['position'];
											$_SESSION["startDate"] = $res['startDate'];
								
											$startDate = $_SESSION['startDate'];
											$newStartDate = date('Y-m-d', strtotime($startDate));
											$_SESSION['startDate'] = $newStartDate;
											
											$_SESSION["endDate"] = $res['endDate'];
											
											$endDate = $_SESSION['endDate'];
											$newEndDate = date('Y-m-d', strtotime($endDate));
											$_SESSION['endDate'] = $newEndDate;
											
											
											$_SESSION["user_ID"] = $res['user_ID'];
											$_SESSION["groupName"] = $res['groupName'];
											$_SESSION["description"] = $res['Description'];
											$_SESSION["duration"] = $res['duration'];
										} 
										
									
									?>
									<div class="tab-content p-3">
										<!--- EDIT EXPERIENCE -->
										<div class="tab-pane active" id="experience">
											<div class="row">
												<div class="col-lg-12">
													<div class="card">
														<div class="card-body">
															<div class="d-flex justify-content-between align-items-center mb-3">
																<div class="card-title">Edit Experience</div>
																<div>
																	<button onclick="deleteExperience()" class="btn btn-danger delete-button" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">X</button>
																</div>
															</div>
															<hr>
															<form method="POST" action="assets/php/process_editExperience.php?exp_ID=<?php echo $exp_ID; ?>">
																<div class="form-group">
																  <label for="input-1">Type</label>
																  <select class="form-control" id="input-1" name="input-1">
																	<option value="Part-time" <?php if(isset($_SESSION['type']) && $_SESSION['type'] === 'Part-time') echo 'selected'; ?>>Part-time job</option>
																	<option value="Full-time" <?php if(isset($_SESSION['type']) && $_SESSION['type'] === 'Full-time') echo 'selected'; ?>>Full-time job</option>
																	<option value="Club" <?php if(isset($_SESSION['type']) && $_SESSION['type'] === 'Club') echo 'selected'; ?>>Club</option>
																	<option value="Association" <?php if(isset($_SESSION['type']) && $_SESSION['type'] === 'Association') echo 'selected'; ?>>Association</option>
																  </select>
																</div>

																
																<div class="form-group">
																	<label for="input-2">Company/Club/Assocatiation</label>
																	<input type="text" class="form-control" name = "input-2" id="input-2" value = "<?php echo $_SESSION["groupName"];?>">
																</div>
																
																<div class="form-group">
																	<label for="input-2">Position</label>
																	<input type="text" class="form-control" name = "input-3" id="input-3" value = "<?php echo $_SESSION["position"];?>">
																</div>
																
																<div class="form-group">
																	<label for="input-3">Start Date</label>
																	<input type="date" class="form-control" name = "input-4" id="input-4" value="<?php echo $_SESSION['startDate']; ?>">
																</div>

																
																<div class="form-group">
																	<label for="input-3">End Date</label>
																	<input type="date" class="form-control" name = "input-5" id="input-5" value="<?php echo $_SESSION['endDate']; ?>">
																</div>


																
																<div class="form-group">
																	<textarea name = "input-6" id="description" class="form-control" rows="10"><?php echo $_SESSION['description']; ?></textarea>
																</div>

																
																<div class="form-group">
																	<button type="submit" class="btn btn-primary"> Save Edit</button>	
																</div>
																
															</form>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--start overlay-->
							<div class="overlay toggle-menu"></div>
							<!--end overlay-->
						</div>
						<!-- End container-fluid-->
					</div><!--End content-wrapper-->
	   
	   
			<!--Start Back To Top Button-->
			<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
			<!--End Back To Top Button-->
			
			<script>
			
			function deleteExperience() {
			  // Get the value from PHP using PHP tags in your HTML file
			  var exp_ID = "<?php echo $exp_ID; ?>";

			  // Ask for confirmation before deleting
			  if (confirm("Are you sure you want to delete this experience?")) {
				$.ajax({
				  url: 'assets/php/process_deleteExperience.php',
				  method: 'POST',
				  data: { exp_ID: exp_ID },
				  success: function(response) {
					// Handle the response from the PHP script
					console.log(response);
					alert("The experience has been deleted!");
					// Reload the current page
					window.location.href = "editProfile.php";
				  },
				  error: function(xhr, status, error) {
					// Handle the error
					console.log(error);
				  }
				});
			  } else {
				// User clicked "Cancel", stop further execution or perform any other necessary action
				return;
			  }
			}


			</script>
			<!--Start footer-->
			<footer class="footer">
				<div class="container">
					<div class="text-center">
					
													
					</div>
			  </div>
			</footer>
			<!--End footer-->
		
			<!--start color switcher-->
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
		  <!--end color switcher-->
		   
		</div><!--End wrapper-->


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
<?php 
	}
?>