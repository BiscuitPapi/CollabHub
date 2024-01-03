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
		<title>Peer Review</title>
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
			.img-circle {
				border-radius: 50%;
				object-fit: cover; /* Maintain image aspect ratio */
				/* Add any additional styles or adjustments as needed */
			}

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
			<?php include_once('sidebar.php'); ?>
			<?php include_once('topbar.php'); ?>
			
			<div class="clearfix"></div>
		
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12 col-lg-8 col-xl">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title">Peers</h5>
									<div class="table-responsive">
										<table class="table table-hover">
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">Peer Name</th>
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
															echo '<tr><td colspan="4">No peers to review yet.</td></tr>';
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
			<script src="assets/js/inviteMM.js"></script>
    
			<script>
				displayNotifications();
			</script>					
		
	</body>
</html>

<?php 
	}
	
?>