<?php
	session_start();
	// Check if the session variable exists
	if (!isset($_SESSION['user_ID'])) {
		// Redirect to the login page
		header("Location: login.php");
		exit();
	}
	else {
		
		if (isset($_POST['user_ID'])) {
		  $user_ID = $_POST['user_ID'];
		}

		elseif (isset($_GET['user_ID'])) { // Check if a user ID is provided through the URL
			$user_ID = $_GET['user_ID'];
			include("assets/php/connection.php");
			$sql = "SELECT * FROM user WHERE user_ID ='$user_ID'";

			// execute the query
			$result = mysqli_query($connection, $sql);

			// check if the query returned any rows
			if (mysqli_num_rows($result) > 0) {
			  // email and password are correct
				$res = $result->fetch_assoc();
				$about = $res['user_ID'];
				$about = $res['about'];
				$name = $res['name'];
				$email = $res['email'];
				$position = $res['position'];
			} 
			
		  
		} 
		
		else { // Use the session user ID as a fallback
		  
			$user_ID = $_SESSION['user_ID'];
			$name = $_SESSION['name'];
			$about = $_SESSION['about'];
		    $email = $_SESSION['email'];
			$position = $_SESSION['position'];
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
		<title>My Profile</title>
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
			.star-rating {
				font-size: 24px;
			}
			
			.fa-star {
				color: gray;
			}
			
			.checked {
				color: gold;
			}

			.img-circle {
				border-radius: 50%;
				object-fit: cover; /* Maintain image aspect ratio */
				/* Add any additional styles or adjustments as needed */
			}
		</style>
	</head>

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
								<span class="user-profile">
									<img class="img-circle" src="data:image/jpeg;base64,<?php echo $_SESSION['picture']; ?>">	
								</span>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li class="dropdown-item user-details">
									<a href="myProfile.php">
										<div class="media">
											<div class="avatar">
												<img class="align-self-start mr-3" src="data:image/jpeg;base64,<?php echo $_SESSION['picture']; ?>" alt="profile-image">	
											</div>
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
			<!--End topbar header-->

			<div class="clearfix"></div>
		
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row mt-3">
						<div class="col-lg-4">
							<div class="card profile-card-2">
							<div class="card-img-block">
								<?php if ($_SESSION['banner'] !== null): ?>
									<img class="img-fluid banner" src="data:image/jpeg;base64,<?php echo $_SESSION['banner']; ?>" alt="Banner Image">
								<?php else: ?>
									<img class="img-fluid" src="assets/php/image.php?picture=banner&user_ID=<?php echo $user_ID; ?>" alt="banner-image" class="banner">
								<?php endif; ?>
							</div>

								<div class="card-body pt-5">
								<div class="avatar">
									<?php if ($_SESSION['picture'] === null): ?>
										<div>
											<img src="assets/php/image.php?picture=profile&user_ID=<?php echo $user_ID; ?>" alt="profile-image" class="profile">
										</div>
									<?php else: ?>
										<div>
											<img  src="data:image/jpeg;base64,<?php echo $_SESSION['picture']; ?>" alt="Profile Image" class="profile">
										</div>
									<?php endif; ?>
								</div>


									<h5 class="card-title"><?php echo $name; ?></h5>
									<p class="card-text"><?php echo $position; ?></p>
									<div class="icon-block">
										<a href="javascript:void();"> <i class="fa fa-facebook bg-facebook text-white"></i></a>
										<a href="javascript:void();"> <i class="fa fa-twitter bg-twitter text-white"></i></a>
										<a href="javascript:void();"> <i class="fa fa-google-plus bg-google-plus text-white"></i></a>
									</div>
								</div>

								<div class="card-body border-top border-light">
									<?php
									include("assets/php/connection.php");

									$badgeTypes = array(
										'Technical Skills' => 'Technical Skills',
										'Soft Skills' => 'Soft Skills',
										'Others' => 'Others'
									);

									echo "<div class='media align-items-center'>";
									echo "<div class='progress-wrapper'>";

									foreach ($badgeTypes as $key => $type) {
										$sql = "SELECT * FROM badge WHERE type = '$type' AND user_ID ='$user_ID'";

										$result = mysqli_query($connection, $sql);

										echo "<h6>$key</h6>";

										if (mysqli_num_rows($result) > 0) {
											echo "<div class='badge-container d-flex flex-wrap'>";
											while ($row = mysqli_fetch_assoc($result)) {
												echo "<div class='badge-wrapper'>";
												echo "<a class='badge badge-dark badge-pill'>" . $row['name'] . "</a>";
												echo "</div>";
											}
											echo "</div>";
										} else {
											echo "No $key badges found.";
										}

										echo "<br><hr>";
									}

									echo "</div>";
									echo "</div>";
									?>
								</div>
							</div>
						</div>

						<div class="col-lg-8">
							<div class="card">
								<div class="card-body">
									<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
										<li class="nav-item">
											<a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="zmdi zmdi-account-box-mail"></i> <span class="hidden-xs">About</span></a>
										</li>
										<li class="nav-item">
											<a href="javascript:void();" data-target="#adjust" data-toggle="pill" class="nav-link"><i class="zmdi zmdi-assignment-o"></i> <span class="hidden-xs">Experience</span></a>
										</li>
										<li class="nav-item">
											<a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link"><i class="zmdi zmdi-accounts-outline"></i> <span class="hidden-xs">Review</span></a>
										</li>
									</ul>
									
									<div class="tab-content p-3">
										<div class="tab-pane active" id="profile">
											<div class="row">
												<div class="col-md-12">
													<h5 class="mb-3"></h5>
													<?php echo $about;?>
													<br><br><br>
												</div>
												
											
												
												
											</div>
											<!--/row-->
										</div>
										
										<!-- EXPERIENCE -->
										
										<div class="tab-pane" id="adjust">
											<div class="row">
												<?php
												include("assets/php/connection.php");
												$results_per_page = 2; // Number of rows to display per page
												$sql = "SELECT * FROM experience WHERE user_ID = '{$user_ID}'";
												$result = mysqli_query($connection, $sql);
												$num_results = mysqli_num_rows($result);
												$num_pages = ceil($num_results / $results_per_page); // Calculate number of pages
												if (!isset($_GET['page'])) { // Set default page to 1
													$page = 1;
												} else {
													$page = $_GET['page'];
												}
												$start_index = ($page - 1) * $results_per_page; // Calculate starting index for current page
												$sql .= " LIMIT $start_index, $results_per_page";
												$result = mysqli_query($connection, $sql);
												if (mysqli_num_rows($result) > 0) {
													while ($row = mysqli_fetch_assoc($result)) {
														?>
														<div class="col-md-12">
															<h5 style="display:"><?php echo $row['position'];?></h5>
															<?php echo $row['type']." - ".$row['groupName']; ?>
															<?php echo "<br>";?>
															<?php echo $row['duration']; ?>
															<?php echo "<br><br>";?>
															<p><?php echo $row['Description']; ?></p>
															<?php echo "<br><hr>";?>
														</div>
														<?php
													}
													// Display pagination buttons
													echo '<div class="col-md-12">';
													echo '<ul class="pagination justify-content-center">';
													for ($i = 1; $i <= $num_pages; $i++) {
														if ($i == $page) {
															echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
														} else {
															echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
														}
													}
													echo '</ul>';
													echo '</div>';
												} else {
													echo "No experiences found.";
												}
												?>
												</div>
											</div>
									
										<!-- REVIEW -->
										<div class="tab-pane" id="edit">
											<div class="row">
												<?php
												include("assets/php/connection.php");
												
												$sql = "SELECT review_ID, reviewer FROM feedback WHERE reviewee = '{$user_ID}'";
												$result = mysqli_query($connection, $sql);

												if (mysqli_num_rows($result) > 0) {
													while ($row = mysqli_fetch_assoc($result)) {
														$review_id = $row['review_ID'];
														$reviewer = $row['reviewer'];
														
														// Get reviewer's name from user table
														$sql_user = "SELECT name FROM user WHERE user_ID = '$reviewer'";
														$result_user = mysqli_query($connection, $sql_user);
														$row_user = mysqli_fetch_assoc($result_user);
														$reviewer_name = $row_user['name'];
																												
														$review_sql = "SELECT comments, stars FROM review WHERE review_ID = '$review_id'";
														$review_result = mysqli_query($connection, $review_sql);
														if (mysqli_num_rows($review_result) > 0) {
															while ($review_row = mysqli_fetch_assoc($review_result)) {
																$comments = $review_row['comments'];
																$stars = $review_row['stars'];
																?>
																<div class="col-md-12">
																	<img src="assets/php/imageReviewIcon.php?user_ID=<?php echo $reviewer?>" alt="profile-image" class="profile" style="border-radius: 50%; width: 50px; height: 50px; display: inline-block;">
																	<h5 style="display: inline-block; margin-left: 10px;"><?php echo $reviewer_name;?></h5>
																	<br>
																	<div class="star-rating">
																		<?php
																		for ($i = 1; $i <= 5; $i++) {
																			if ($i <= $stars) {
																				echo '<span class="fa fa-star checked"></span>';
																			} else {
																				echo '<span class="fa fa-star"></span>';
																			}
																		}
																		?>
																	</div>
																	<!-- The comments -->
																	<p><?php echo $comments; ?></p>
																	<?php echo "<hr>";?>
																</div>
																<?php
																echo "<br><br>";
															}
														}
													}
												} else {
													echo "No reviews found.";
												}
												?>

											</div>
										
											<br>	
											
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