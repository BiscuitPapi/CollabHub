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
		<title>To Review</title>
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
				cursor: pointer;
			}
			
			.checked,
			.fa-star:hover {
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
			<?php include_once('sidebar.php'); ?>
			<?php include_once('topbar.php'); ?>

			<div class="clearfix"></div>
		
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-12 col-lg-8 col-xl">
							<div class="card">
								<div class="card-body">
									<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
										<li class="nav-item">
											<a href="javascript:void();" data-target="#toReview" data-toggle="pill" class="nav-link"><i class="zmdi zmdi-assignment-o"></i> <span class="hidden-xs">Peer Review</span></a>
										</li>
									</ul>
									
	
									<div class="tab-content p-3">
										<!--- EDIT ABOUT -->
										<div class="tab-pane active" id="toReview">
											<div class="row">
												<div class="col-lg-12">
													<div class="card">
														<div class="card-body">
															<div class="card-title">Give Feedback</div>
															<hr>
															
															<!----  Form  ---->
															<form method="POST" action="assets/php/process_addReview.php" id="toReview" onsubmit="return validateForm()">
																<!----  Type  ---->
																<div class="form-group">
																  <label for="input-1">Peer</label>
																  <div class="position-relative has-icon-right">
																	<select class="form-control" id="input_1" name="input_1">
																	  <?php
																		include("assets/php/connection.php");
																		
																		// Retrieve the feedback data for the current user
																		$feedbackQuery = "SELECT * FROM feedback WHERE reviewer = '" . $_SESSION['user_ID'] . "' AND review_ID IS NULL";
																		$feedbackResult = mysqli_query($connection, $feedbackQuery);
																		
																		while ($row = mysqli_fetch_assoc($feedbackResult)) {
																		  // Retrieve the user data based on the review ID
																		  $userQuery = "SELECT * FROM user WHERE user_ID = '" . $row['reviewee'] . "'";
																		  $userResult = mysqli_query($connection, $userQuery);
																		  $row2 = mysqli_fetch_assoc($userResult);
																		  
																		  // Display the user's name as the option and use their user_ID as the value
																		  echo '<option value="' . $row2['user_ID'] . '">' . $row2['name'] . '</option>';
																		}
																		
																		// Close the database connection
																		mysqli_close($connection);
																	  ?>
																	</select>
																  </div>
																</div>

																
																
																<div class="form-group">
																	<label for="input-2">Stars</label>
																	<div class="position-relative has-icon-right">
																		<div class="star-rating">
																			<span class="fa fa-star"></span>
																			<span class="fa fa-star"></span>
																			<span class="fa fa-star"></span>
																			<span class="fa fa-star"></span>
																			<span class="fa fa-star"></span>
																		</div>
																		<input type="hidden" id="input_2" name="input_2" class="form-control input-shadow" required>
																	</div>
																</div>

																
																<script>
																  const starRating = document.querySelector('.star-rating');
																  const stars = starRating.getElementsByClassName('fa-star');
																  const inputField = document.getElementById('input_2');
																  let rating = 0;
																  
																  function setRating(ratingValue) {
																	rating = ratingValue;
																	for (let i = 0; i < stars.length; i++) {
																	  if (i < ratingValue) {
																		stars[i].classList.add('checked');
																	  } else {
																		stars[i].classList.remove('checked');
																	  }
																	}
																	inputField.value = ratingValue;
																  }
																  
																  function resetRating() {
																	setRating(rating);
																  }
																  
																  Array.from(stars).forEach((star, index) => {
																	star.addEventListener('click', () => {
																	  setRating(index + 1);
																	});
																	
																	star.addEventListener('mouseover', () => {
																	  for (let i = 0; i <= index; i++) {
																		stars[i].classList.add('checked');
																	  }
																	});
																	
																	star.addEventListener('mouseout', () => {
																	  resetRating();
																	});
																  });
																  
																  starRating.addEventListener('mouseout', () => {
																	resetRating();
																  });
																
																  function validateForm() {
																	const starsInput = document.getElementById('input_2');
																	const starsValue = parseInt(starsInput.value);
																	
																	if (starsValue === 0) {
																	  alert("Please select a star rating.");
																	  return false; // Cancel form submission
																	}
																	
																	return true; // Allow form submission
																  }

																  
																</script>	
																
																<div class="form-group">
																	<label for="input-6">Comments</label>
																	<textarea id = "input_3" name = "input_3" class="form-control" rows="10" placeholder="Share some thoughts on your peer to help others know them better" required></textarea>
																</div>
																
																<button type="submit" value="Submit" class="btn btn-light btn-block btn-success">Submit</button>
															</form>
																
														
														</div>
													</div>
												</div>
											</div>
										</div>
									
										
										
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				
				
				
				
				
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
			<script src="assets/js/notification.js"></script>
    
			<script>
				displayNotifications();
			</script>		
	</body>
</html>

<?php 
	}
?>