<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('assets/php/connection.php');
// Check if the session variable exists
if (!isset($_SESSION['user_ID'])) {
	// Redirect to the login page
	header("Location: login.php");
	exit();
} else {

	if (isset($_GET['studyhub_ID'])) {
		$studyhub_ID = $_GET['studyhub_ID'];
		// Fetch the study hub profile based on the studyhub_ID
		$sql = "SELECT * FROM studyhub WHERE studyhub_ID = '$studyhub_ID'";

		// Execute the query
		$result = mysqli_query($connection, $sql);

		// Check if the query returned any rows
		if (mysqli_num_rows($result) > 0) {
			// Study hub profile found


			$studyhub = mysqli_fetch_assoc($result);
			$_SESSION['studyhub_name'] = $studyhub['studyhub_name'];
			$_SESSION['studyhub_description'] = $studyhub['studyhub_description'];
			$_SESSION['setting'] = $studyhub['setting'];
			$date_created = $studyhub['date_created'];
			$user_ID = $studyhub['user_ID'];

			// Store the banner picture properly as a base64-encoded string
			$studyHub_banner = $studyhub['background_pic'];
			if ($studyHub_banner !== null) {
				$banner = base64_encode($studyHub_banner);
			} else {
				$banner = null;
			}

			$studyHub_profile = $studyhub['profile_pic'];
			if ($studyHub_profile !== null) {
				$proPic = base64_encode($studyHub_profile);
			} else {
				$proPic = null;
			}

			$user_ID = $_SESSION["user_ID"];

			$sql = "SELECT i.invite_ID, sh.studyhub_ID, sh.studyhub_name, sh.profile_pic 
					FROM studyhub sh
					INNER JOIN invitation i ON sh.studyHub_ID = i.studyHub_ID
					WHERE i.user_ID = $user_ID
					AND i.status = 'Pending'";


			$result = $connection->query($sql);

		}


	} else {
		header("Location: myStudyHub.php");
		exit();
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
		<title>StudyHub</title>
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

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.css">

		<style>
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
				object-fit: cover;
				/* Maintain image aspect ratio */
				/* Add any additional styles or adjustments as needed */
			}

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

			/* Modal content */
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
			<?php include_once('sidebar.php'); ?>
			<?php include_once('topbar.php'); ?>

			<div class="clearfix"></div>

			<div class="content-wrapper">
				<div class="container-fluid">
					<!-- New row or section -->
					<div class="row">
						<!--Start of First Column-->
						<div class="col-4">
							<!-- Banner Image-->
							<div class="card profile-card-2">
								<div class="card-img-block">
									<?php
									if ($banner === null) {
										// Display a placeholder image if $studyhub_banner is null
										echo '
											<div class="card-img-block">
												<img class="img-fluid" src="https://via.placeholder.com/800x500" alt="Card image cap" id ="bannerPicture">
											</div>';
									} else {
										// Display the banner image if $studyhub_banner is not null
										echo '
   									 <img class="img-fluid banner" src="data:image/jpeg;base64,' . $banner . '" alt="Banner Image" id="bannerPicture">';
									}
									?>

								</div>

								<!--Profile Card-->
								<div class="card-body pt-5">
									<?php

									if ($proPic === null) {
										// Display a placeholder image if $proPic is null
										echo '<img src="https://via.placeholder.com/110x110" alt="profile-image" class="profile" id ="profilePicture">';
									} else {
										// Display the profile image if $proPic is not null
										echo '<img src="data:image/jpeg;base64,' . $proPic . '" alt="profile-image" class="profile" id ="profilePicture">';
									}


									?>



									<h5 class="card-title">
										<?php echo $_SESSION['studyhub_name']; ?>
									</h5>
									<p class="card-text">
										<?php echo $_SESSION['studyhub_description']; ?>
									</p>
								</div>

								<!--Start of Display Members-->
								<div class="card-body border-top border-light">
									<h5 class="mb-3">StudyHub Members</h5>
									<?php
									$sql2 = "SELECT u.name, u.picture
											FROM studyhub_members AS sm
											JOIN user AS u ON sm.user_ID = u.user_ID
											WHERE sm.studyhub_ID = '$studyhub_ID';";

									// Execute the query
									$result = mysqli_query($connection, $sql2);

									// check if the query returned any rows
									if (mysqli_num_rows($result) > 0) {
										$counter = 0; // Counter to keep track of the number of displayed members
								
										while ($studyhub_member = mysqli_fetch_assoc($result)) {
											$name = $studyhub_member['name'];
											$user_picture = $studyhub_member['picture'] ? base64_encode($studyhub_member['picture']) : null;

											// Display only up to 4 members
											if ($counter < 4) {
												?>
												<div class="media align-items-center">
													<div class="rounded-circle" style="width: 50px; height: 50px; overflow: hidden;">
														<?php if ($user_picture === null): ?>
															<div>
																<img src="https://via.placeholder.com/110x110" alt="profile-image"
																	class="rounded-circle" style="width: 100%; height: auto;"
																	alt="User Picture">
															</div>
														<?php else: ?>
															<div>
																<img src="data:image/jpeg;base64,<?php echo $user_picture; ?>"
																	class="rounded-circle" style="width: 100%; height: auto;"
																	alt="User Picture">
															</div>
														<?php endif; ?>

													</div>

													<div class="media-body text-left ml-3">
														<div class="wrapper">
															<p style="font-size: 20px;">
																<?php echo $name; ?>
															</p> <!-- Adjust the font-size as needed -->
														</div>
													</div>
												</div>
												<hr>
												<?php
												$counter++;
											}
										}

										// If no members were displayed, show a message
										if ($counter === 0) {
											echo "No members found.";
										}
									} else {
										echo "No members found.";
									}
									?>
								</div>
								<!--End of Display Members-->

							</div>



						</div>
						<!--End of First Column-->





						<!--Start of Second Column-->

						<div class="col-12 col-lg-8 col-xl">
							<div class="card">
								<div class="card-body">
									<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
										<li class="nav-item">
											<a href="javascript:void();" data-target="#studysession" data-toggle="pill"
												class="nav-link active"><i class="icon-user"></i> <span
													class="hidden-xs">Study Session</span></a>
										</li>
									</ul>


									<div class="tab-content p-3">
										<!--Start of First Tab-->
										<div class="tab-pane active" id="studysession">

											<!--Today Study Session-->
											<div class="row">
												<div class="col-md-12">
													<h5 class="mt-2 mb-3"><span class=""></span> Today</h5>
													<div class="table-responsive">
														<table class="table table-hover table-striped">
															<tbody>
																<?php
																include("assets/php/connection.php");

																//$query = "SELECT * FROM `study_session` WHERE studyhub_ID = '$studyhub_ID';";
																$query = "SELECT s.*, sm.studysession_id AS member_studysession_id
																FROM `study_session` s
																LEFT JOIN `studysession_member` sm ON s.studysession_id = sm.studysession_id AND sm.user_ID = '$user_ID'
																WHERE s.studyhub_ID = '$studyhub_ID';";


																$result = mysqli_query($connection, $query);

																$count = 1; // Initialize count variable
																$hasRows = false; // Initialize $hasRows to false
															


																// Check if there are no studysessions or no rows found
																if (mysqli_num_rows($result) == 0) {
																	//echo '<tr><td colspan="4">No study session found.</td></tr>';
															
																} else {
																	while ($row = mysqli_fetch_assoc($result)) {

																		// Convert the retrieved date to a timestamp
																		$sessionDate = strtotime($row['studysession_date']);

																		if (date("Y-m-d", $sessionDate) == date("Y-m-d")) {

																			// id in study_session
																			$studysession_id = $row['studysession_id'];

																			// id in studysession_member
																			$member_studysession_id = $row['member_studysession_id'];

																			// Check if the 'studysession_id' is not null, indicating that the user has joined the session
																			$userHasJoined = !is_null($row['member_studysession_id']);

																			// Determine the button label based on the user's status
																			$buttonLabel = $userHasJoined ? 'View' : 'Join';

																			echo '
																				<tr>
																					<th scope="row">' . $count . '</th>
																					<td>' . $row['studysession_name'] . '</td>
																					<td>' . $row['studysession_date'] . '</td>
																					<td><a href="' . ($userHasJoined ? 'view-session.php' : 'assets/php/process_joinStudySession.php') . '?studysession_id=' . $studysession_id . '" class="btn ' . ($userHasJoined ? 'btn-info' : 'btn-success') . '">' . $buttonLabel . '</a></td>
																				</tr>
																			';
																			$hasRows = true;


																			$count++; // Increment count for each row
																		}


																	}
																}

																// Check if no rows are echoed
																if (!$hasRows) {
																	echo '<tr><td colspan="4">No session for today.</td></tr>';
																}

																// Close the database connection
																mysqli_close($connection);
																?>
															</tbody>
														</table>

													</div>
												</div>
											</div>
											<!--End of Today Session-->
											<br>
											<!--Start of Next Session-->
											<div class="row">
												<div class="col-md-12">
													<h5 class="mt-2 mb-3"><span
															class="fa fa-clock-o ion-clock float-right"></span> Up coming
													</h5>
													<div class="table-responsive">
														<table class="table table-hover table-striped">
															<tbody>
																<?php
																include("assets/php/connection.php");


																$query = "SELECT s.*, sm.studysession_id AS member_studysession_id
																FROM `study_session` s
																LEFT JOIN `studysession_member` sm ON s.studysession_id = sm.studysession_id AND sm.user_ID = '$user_ID'
																WHERE s.studyhub_ID = '$studyhub_ID';";

																$result = mysqli_query($connection, $query);

																$count = 1; // Initialize count variable
															
																// Check if there are no mentees or no rows found
																if (mysqli_num_rows($result) == 0) {
																	echo '<tr><td colspan="4">No study session found.</td></tr>';
																} else {
																	while ($row = mysqli_fetch_assoc($result)) {

																		// Convert the retrieved date to a timestamp
																		$sessionDate = strtotime($row['studysession_date']);

																		if (date("Y-m-d", $sessionDate) > date("Y-m-d") && date("Y-m-d", $sessionDate) != date("Y-m-d")) {

																			// id in study_session
																			$studysession_id = $row['studysession_id'];

																			// id in studysession_member
																			$member_studysession_id = $row['member_studysession_id'];

																			// Check if the 'studysession_id' is not null, indicating that the user has joined the session
																			$userHasJoined = !is_null($row['member_studysession_id']);

																			// Determine the button label based on the user's status
																			$buttonLabel = $userHasJoined ? 'View' : 'Join';

																			echo '
																				<tr>
																					<th scope="row">' . $count . '</th>
																					<td>' . $row['studysession_name'] . '</td>
																					<td>' . $row['studysession_date'] . '</td>
																					<td>  <a href="' . ($userHasJoined ? 'view-session.php' : 'assets/php/process_joinStudySession.php') . '?studysession_id=' . $studysession_id . '" class="btn ' . ($userHasJoined ? 'btn-info' : 'btn-success') . '">' . $buttonLabel . '</a>
																					</td>
																				</tr>
																			';
																			$count++; // Increment count for each row
																		}

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
											<!--End of Next Session-->
											<p></p>
											<!--Start of Create study session button-->
											<div class=row>
												<div class="col-md-12">

													<center><a class="btn btn-primary"
															href="create-studysession.php?studyhub_ID=<?php echo $studyhub_ID; ?>">Create
															Session</a></center>
												</div>
											</div>
										</div>
										<!--End of First Tab-->

									</div>



								</div>
							</div>







						</div>
						<!--End of Second Column-->

						<div id="message"></div>


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