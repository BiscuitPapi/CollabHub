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
		<title>Suggested Members</title>
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
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
				color: #ff0000;
				font-weight: bold;
				font-size: 18px; /* Adjust the font size to make the X button bigger */
				margin-left: 5px; /* Add some spacing between the input field and the X button */
				padding: 4px 8px; 
				text-decoration: none;
				margin-left: 5px; /* Add some spacing between the input field and the X button */
				margin-right: -10px; /* Move the X button towards the right edge of the badge */
			}
			.badge-pill {
				display: flex;
				align-items: center;
			}
			.badge-input {
				width: 60%; /* Adjust the width as per your preference */
				display: inline-block;
				vertical-align: middle;
			}

			.badge-name {
				margin-right: 5px; /* Add some spacing between the badge name and input field */
			}
			
		  .star-rating {
			font-size: 24px;
		  }
		  
		  .fa-star {
			color: gray;
		  }
		  
		  .checked {
			color: gold;
		  }


		body {
		  transition: filter 0.3s ease-in-out;
		}

		.container {
		  display: none;
		  position: fixed;
		  top: 50%;
		  left: 50%;
		  transform: translate(-50%, -50%);
		  background-color: white;
		  padding: 20px;
		  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
		  z-index: 9999;
		  width: 50%;
		}

		.container.active {
		  display: block;
		}

		.close-btn {
		  position: absolute;
		  bottom: 10px;
		  right: 10px;
		  cursor: pointer;
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
						<li class="nav-item dropdown-lg">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
							<i class="fa fa-bell-o"></i></a>
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
					<div class="row">
						<div class="col-12 col-lg-8 col-xl">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Suggestions</h5>
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
												<?php
														include("assets/php/connection.php");

														$query = "SELECT * FROM feedback WHERE reviewer = '" . $_SESSION['user_ID'] . "' AND review_ID IS NULL";
														$result = mysqli_query($connection, $query);

														$count = 1; // Initialize count variable

														// Check if there are no mentees or no rows found
														if (mysqli_num_rows($result) == 0) {
															echo '<tr><td colspan="4">No potential members found.</td></tr>';
														} 
														
														else {
															while ($row = mysqli_fetch_assoc($result)) {
																$query_2 = "SELECT * FROM user WHERE user_ID = '" . $row['reviewee'] . "'";
																$result_2 = mysqli_query($connection, $query_2);
																$row_2 = mysqli_fetch_assoc($result_2);

																// Output each row of the table
																echo '
																	<tr>
																		<th scope="row">' . $count . '</th>
																		<td>' . $row_2['name'] . '</td>
																		<td>
																		<a href="toReview.php?user_ID=' . $row_2['user_ID'] . '" class="btn btn-success">Rate</a>
																		</td>
																	</tr>
																	';

																$count++; // Increment count for each row
															}
														}

														// Close the database connection
														mysqli_close($connection);
													?>

											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Start Back To Top Button-->
				<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
				<!--End Back To Top Button-->
			
				<script>
				function approval(mt_ID, answer) {
					var answerText = answer.toLowerCase();
					if (answerText === "rejected") {
						answerText = answerText.slice(0, -2);
					} else {
						answerText = answerText.slice(0, -1);
					}
					if (confirm("Are you sure you want to " + answerText  +" this application?")) {
						$.ajax({
							url: 'assets/php/process_applicationApproval.php',
							method: 'POST',
							data: { mt_ID: mt_ID, status: answer },
							success: function(response) {
								// Handle the response from the PHP script
								console.log(response);
								if (answer == "Rejected")
									alert("Application has been rejected!");
								else
									alert("Application has been approved!");
							},
							error: function(xhr, status, error) {
								// Handle the error
								console.log(error);
							}
						});
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
			</div>
			<!--End wrapper-->

		
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

<?php 
	}
	
?>