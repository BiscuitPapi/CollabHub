<?php
session_start();
// Check if the session variable exists
if (!isset($_SESSION['user_ID'])) {
	// Redirect to the login page
	header("Location: login.php");
	exit();
} else {

	if (isset($_POST['user_ID'])) {
		$user_ID = $_POST['user_ID'];
	} elseif (isset($_GET['user_ID'])) { // Check if a user ID is provided through the URL
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


	} else { // Use the session user ID as a fallback

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
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<title>My Profile</title>
		<!-- loader-->
		<link href="assets/css/pace.min.css" rel="stylesheet" />
		<script src="assets/js/pace.min.js"></script>
		<!--favicon-->
		<link rel="icon" href="assets/images/CB-favi.ico" type="image/x-icon">
		<!-- simplebar CSS-->
		<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
		<!-- Bootstrap core CSS-->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<!-- animate CSS-->
		<link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
		<!-- Icons CSS-->
		<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
		<!-- Sidebar CSS-->
		<link href="assets/css/sidebar-menu.css" rel="stylesheet" />
		<!-- Custom Style-->
		<link href="assets/css/app-style.css" rel="stylesheet" />

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
				object-fit: cover;
				/* Maintain image aspect ratio */
				/* Add any additional styles or adjustments as needed */
			}
		</style>
	</head>

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
			<?php include_once('sidebar.php'); ?>
			<?php include_once('topbar.php'); ?>

			<div class="clearfix"></div>

			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row mt-3">
						<div class="col-lg-4">
							<div class="card profile-card-2">
								<div class="card-img-block">
									<?php if ($_SESSION['banner'] !== null): ?>
										<img class="img-fluid banner"
											src="data:image/jpeg;base64,<?php echo $_SESSION['banner']; ?>" alt="Banner Image">
									<?php else: ?>
										<img class="img-fluid" src="https://via.placeholder.com/500x300" alt="banner-image"
											class="banner">
									<?php endif; ?>
								</div>

								<div class="card-body pt-5">
									<div class="avatar">
										<?php if ($_SESSION['picture'] === null): ?>
											<div>
												<img src="https://via.placeholder.com/110x110" alt="profile-image"
													class="profile">
											</div>
										<?php else: ?>
											<div>
												<img src="data:image/jpeg;base64,<?php echo $_SESSION['picture']; ?>"
													alt="Profile Image" class="profile">
											</div>
										<?php endif; ?>
									</div>


									<h5 class="card-title">
										<?php echo $name; ?>
									</h5>
									<p class="card-text">
										<?php echo $position; ?>
									</p>
									<div class="icon-block">
										<a href="javascript:void();"> <i
												class="fa fa-facebook bg-facebook text-white"></i></a>
										<a href="javascript:void();"> <i
												class="fa fa-twitter bg-twitter text-white"></i></a>
										<a href="javascript:void();"> <i
												class="fa fa-google-plus bg-google-plus text-white"></i></a>
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
											<a href="javascript:void();" data-target="#profile" data-toggle="pill"
												class="nav-link active"><i class="zmdi zmdi-account-box-mail"></i> <span
													class="hidden-xs">About</span></a>
										</li>
										<li class="nav-item">
											<a href="javascript:void();" data-target="#adjust" data-toggle="pill"
												class="nav-link"><i class="zmdi zmdi-assignment-o"></i> <span
													class="hidden-xs">Experience</span></a>
										</li>
										<li class="nav-item">
											<a href="javascript:void();" data-target="#review" data-toggle="pill"
												class="nav-link"><i class="zmdi zmdi-accounts-outline"></i> <span
													class="hidden-xs">Review</span></a>
										</li>
									</ul>

									<div class="tab-content p-3">
										<div class="tab-pane active" id="profile">
											<div class="row">
												<div class="col-md-12">
													<h5 class="mb-3"></h5>
													<?php echo $about; ?>
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
															<h5 style="display:">
																<?php echo $row['position']; ?>
															</h5>
															<?php echo $row['type'] . " - " . $row['groupName']; ?>
															<?php echo "<br>"; ?>
															<?php echo $row['duration']; ?>
															<?php echo "<br><br>"; ?>
															<p>
																<?php echo $row['Description']; ?>
															</p>
															<?php echo "<br><hr>"; ?>
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
										<div class="tab-pane" id="review">
											<div class="row">
												<div class="col-4">
													<h5>Overall Rating: <?php echo number_format($_SESSION["rating"], 2);?></h5>
													</h5>
													<div class="star-rating">
														<?php
														for ($i = 1; $i <= 5; $i++) {
															if ($i <= $_SESSION["rating"]) {
																echo '<span class="fa fa-star checked"></span>';
															} else {
																echo '<span class="fa fa-star"></span>';
															}
														}
														?>

														
													</div>
													<?php 
														$user_ID = $_SESSION["user_ID"];

														$sql = "SELECT COUNT(*) AS count FROM feedback WHERE reviewee = '$user_ID'";
														$result = mysqli_query($connection, $sql);
														
														if ($result) {
															$row = mysqli_fetch_assoc($result);
															$count = $row['count'];
														
															echo  $count . " Reviews";
														} else {
															echo "Error: " . mysqli_error($connection);
														}
													?>
												</div>
												
											</div>
											<hr>
											<div class="row">

												<?php

												error_reporting(E_ALL);
												ini_set('display_errors', 1);
												include("assets/php/connection.php");

												$sql = "SELECT review_ID, reviewer FROM feedback WHERE reviewee = '{$_SESSION["user_ID"]}'";
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

														$review_sql = "SELECT positivity, negativity, comments, stars FROM review WHERE review_ID = '$review_id'";

														$review_result = mysqli_query($connection, $review_sql);
														if (mysqli_num_rows($review_result) > 0) {
															while ($review_row = mysqli_fetch_assoc($review_result)) {
																$comments = $review_row['comments'];
																$stars = $review_row['stars'];
																$positivity = $review_row['positivity'];
																$negativity = $review_row['negativity'];

																?>
																<div class="col-md-12">
																	<img src="assets/php/imageReviewIcon.php?user_ID=<?php echo $reviewer ?>"
																		alt="profile-image" class="profile"
																		style="border-radius: 50%; width: 50px; height: 50px; display: inline-block;">
																	<h5 style="display: inline-block; margin-left: 10px;">
																		<?php echo $reviewer_name; ?>
																	</h5>
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
																	<p>
																		<?php echo $comments; ?>
																	</p>
																	<span class="badge badge-success"><?php echo $positivity; ?>% positive</span>
                           											<span class="badge badge-danger"><?php echo $negativity; ?>% negative</span>		
																		
																	<hr>
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