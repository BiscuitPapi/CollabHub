<?php
session_start();
// Check if the session variable exists
if (!isset($_SESSION['user_ID'])) {
	// Redirect to the login page
	header("Location: login.php");
	exit();
} else {

	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<title>To Review</title>
		<!-- loader-->
		<link href="../assets/css/pace.min.css" rel="stylesheet" />
		<script src="../assets/js/pace.min.js"></script>
		<!--favicon-->
		<link rel="icon" href="../assets/images/CB-favi.ico" type="image/x-icon">
		<!-- simplebar CSS-->
		<link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
		<!-- Bootstrap core CSS-->
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
		<!-- animate CSS-->
		<link href="../assets/css/animate.css" rel="stylesheet" type="text/css" />
		<!-- Icons CSS-->
		<link href="../assets/css/icons.css" rel="stylesheet" type="text/css" />
		<!-- Sidebar CSS-->
		<link href="../assets/css/sidebar-menu.css" rel="stylesheet" />
		<!-- Custom Style-->
		<link href="../assets/css/app-style.css" rel="stylesheet" />
		<!-- <link href="../assets/css/loader.css" rel="stylesheet" type="text/css" /> -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<style>
			/* Unique modal class */
.custom-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.8);
    /* Semi-transparent white background */
    z-index: 1;
}

.custom-modal .modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    text-align: center;
}
/* Loader container */
.custom-modal .loader-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    /* Center both horizontally and vertically */
    height: 100%;
    /* Take full height of the modal content */
}

/* Loader animation (customize as needed) */
.custom-modal .loader {
    border: 8px solid #f3f3f3;
    /* Light grey */
    border-top: 8px solid #3498db;
    /* Blue */
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1.5s linear infinite;
    margin-bottom: 10px;
    /* Add margin to separate loader from the message */
}

			/* Loading message */
			.custom-modal #loadingMessage {
				font-weight: bold;
				color: #333;
			}


			@keyframes spin {
				0% {
					transform: rotate(0deg);
				}

				100% {
					transform: rotate(360deg);
				}
			}
		</style>

	</head>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<body class="bg-theme bg-theme9">
		<!-- start loader -->
		<div id="pageloader-overlay" class="visible incoming">
			<div class="loader-wrapper-outer">
				<div class="loader-wrapper-inner">
					<div class="loader"></div>
				</div>
			</div>
		</div>
		<!-- end loader -->

		<!-- Start wrapper-->
		<div id="wrapper">
			<?php include_once('nav/sidebar.php'); ?>
			<?php include_once('nav/topbar.php'); ?>

			<div class="clearfix"></div>

			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-12 col-lg-8 col-xl">
							<div class="card">
								<div class="card-body">
									<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
										<li class="nav-item">
											<a href="javascript:void();" data-target="#toReview" data-toggle="pill"
												class="nav-link active"><i class="zmdi zmdi-assignment-o"></i> <span
													class="hidden-xs">Peer Review</span></a>
										</li>
									</ul>


									<div class="tab-content p-3">
										<!--- To Review -->
										<div class="tab-pane active" id="toReview">
											<div class="row">
												<div class="col-lg-12">
													<div class="card">
														<div class="card-body">
															<div class="card-title">Give Feedback</div>
															<hr>

															<!----  Form  ---->
															<div id="toReview">
																<!----  Type  ---->
																<div class="form-group">
																	<label for="input-1">Peer</label>
																	<div class="position-relative has-icon-right">
																		<select class="form-control" id="input_1"
																			name="input_1">
																			<?php
																			include("../assets/php/connection.php");
																			$temp = 0;
																			// Retrieve the feedback data for the current user
																			$feedbackQuery = "SELECT * FROM feedback WHERE reviewer = '" . $_SESSION['user_ID'] . "' AND review_ID IS NULL";
																			$feedbackResult = mysqli_query($connection, $feedbackQuery);

																			while ($row = mysqli_fetch_assoc($feedbackResult)) {
																				// Retrieve the user data based on the review ID
																				$userQuery = "SELECT * FROM user WHERE user_ID = '" . $row['reviewee'] . "'";
																				$userResult = mysqli_query($connection, $userQuery);
																				$row2 = mysqli_fetch_assoc($userResult);

																				// Display the user's name as the option and use their user_ID as the value
																				echo '<option value="' . $row2['user_ID'] . "&" . $row['feedback_ID'] . '">' . $row2['name'] . '</option>';
																			}

																			// Close the database connection
																			mysqli_close($connection);
																			?>
																		</select>
																	</div>
																</div>

																<div class="form-group">
																	<label for="input-6">Comments</label>
																	<textarea id="input_3" name="input_3"
																		class="form-control" rows="10"
																		placeholder="Share some thoughts on your peer to help others know them better"
																		required></textarea>
																</div>

																<button class="btn btn-success"
																	onclick="submitReview()">Submit</button>
															</div>

															<div class="custom-modal" id="myCustomModal" style ="display:none;">
															<center>	
															<div class="modal-content">
																	<center>
																		<div class="loader"></div>
																	</center>

																	<p id="loadingMessage">Processing feedback and crafting stars. Hang tight...</p>
																</div>
															</div></center>
																
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
			</div>
			<!--End wrapper-->


			<!-- Bootstrap core JavaScript-->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/popper.min.js"></script>
			<script src="../assets/js/bootstrap.min.js"></script>

			<!-- simplebar js -->
			<script src="../assets/plugins/simplebar/js/simplebar.js"></script>
			<!-- sidebar-menu js -->
			<script src="../assets/js/sidebar-menu.js"></script>

			<!-- Custom scripts -->
			<script src="../assets/js/app-script.js"></script>
			<script src="../assets/js/notification.js"></script>
			<script src="../assets/js/reviews.js"></script>

			<script>
				displayNotifications();
			</script>
	</body>

	</html>

	<?php
}
?>