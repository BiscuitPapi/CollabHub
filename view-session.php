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

		if (isset($_GET['studysession_id'])) {
			$studysession_id = $_GET['studysession_id'];
	
			// Fetch the study hub profile based on the studyhub_ID
			$sql = "SELECT * FROM `study_session` WHERE studysession_id = '$studysession_id'";
	
			// Execute the query
			$result = mysqli_query($connection, $sql);
	
			// Check if the query returned any rows
			if (mysqli_num_rows($result) > 0) {

				$studysession = mysqli_fetch_assoc($result);
				$studyhub_ID = $_POST['studyhub_ID'];
				$studysession_name = $studysession['studysession_name'];
				$studysession_date = $studysession['studysession_date'];
				$studysession_time = $studysession['studysession_time'];
				$studysession_mode = $studysession['studysession_mode'];
				$studysession_link = $studysession['studysession_link'];
				$note = $studysession['note'];
				$created_on = $studysession['created_on'];
				$created_by = $studysession['created_by'];

	
				
			} else {
				// Study hub profile not found, handle the error
				echo "Study session not found.";
			}
		} else {
			// Studyhub ID not provided, handle the error
			echo "Study session ID is not provided.";
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
		
	</head>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
						<li class="nav-item dropdown-lg">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
								<i class="fa fa-bell-o"></i>
							</a>
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
									<div class="card-title">Study Session Information</div>
									<hr>	

									<!--Group Application - Form-->
									<form action="assets/php/process_editStudySession.php?studysession_id=<?php echo $studysession_id; ?>" method="POST">
									<div class="form-group row">
										<label class="col-lg-3">Session Name</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" name = "studysession_name" value="<?php echo $studysession_name;?>" <?php if ($_SESSION['user_ID'] != $created_by) echo 'readonly'; ?>>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3">Session Date</label>
										<div class="col-lg-9">
											<input class="form-control" type="date" name="studysession_date" value="<?php echo $studysession_date;?>" <?php if ($_SESSION['user_ID'] != $created_by) echo 'readonly'; ?>>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 ">Session Time</label>
										<div class="col-lg-9">
											<input class="form-control" type="time" name="studysession_time" value="<?php echo $studysession_time;?>" <?php if ($_SESSION['user_ID'] != $created_by) echo 'readonly'; ?>>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3">Session Mode</label>
										<div class="col-lg-9">

											<?php
												if ($_SESSION['user_ID'] == $created_by) {
													echo '<input type="radio" id="option1" name="studysession_mode" value="Online" ' . ($studysession_mode === 'Online' ? 'checked' : '') . '>
													<label for="option1">Online</label>
													&nbsp;&nbsp;
													<input type="radio" id="option2" name="studysession_mode" value="Physical" ' . ($studysession_mode === 'Physical' ? 'checked' : '') . '>
													<label for="option2">Physical</label>';
												} else {
													echo '<input class="form-control" type="text" name="studysession_mode" value="' . $studysession_mode . '" ' . ($_SESSION['user_ID'] != $created_by ? 'readonly' : '') . '>';
												}
											?>
											

										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3">Session Link</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" name = "studysession_link" value="<?php echo $studysession_link;?>" <?php if ($_SESSION['user_ID'] != $created_by) echo 'readonly'; ?>>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3">Note</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" name = "note" value="<?php echo $note;?>" <?php if ($_SESSION['user_ID'] != $created_by) echo 'readonly'; ?>>
										</div>
									</div>
									
									<?php
										if ($_SESSION['user_ID'] == $created_by) {
											echo '<center><button type="submit" class="btn btn-light px-5">Edit</button></center>';
										}
										else {
											echo '<center><a href="javascript:history.back()" class="btn btn-light" style="margin-left: 10px">Back</a></center>';
										}
									?>
									
										
								</div>
							</div>
						</div>

						<!-- <div class="col-lg-6">
							<div class="card">
								<div class="card-body">
								<h5 class="card-title">Applicant List</h5>
								<div class="table-responsive">
								<table class="table table-hover">
									<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Name</th>
										<th scope="col">Action</th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<th scope="row">1</th>
										<td>Mark</td>
										<td>Otto</td>
									</tr>
									<tr>
										<th scope="row">2</th>
										<td>Jacob</td>
										<td>Thornton</td>
									</tr>
									<tr>
										<th scope="row">3</th>
										<td colspan="2">Larry the Bird</td>
									</tr>
									</tbody>
								</table>
								</div>
								</div>
							</div>
        				</div> -->

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
    
		
	</body>
</html>

