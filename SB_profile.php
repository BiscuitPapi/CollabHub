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
				object-fit: cover; /* Maintain image aspect ratio */
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
				background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
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

			/* Loader animation (customize as needed) */
			.custom-modal .loader {
				border: 8px solid #f3f3f3; /* Light grey */
				border-top: 8px solid #3498db; /* Blue */
				border-radius: 50%;
				width: 50px;
				height: 50px;
				animation: spin 1.5s linear infinite;
			}

			@keyframes spin {
				0% { transform: rotate(0deg); }
				100% { transform: rotate(360deg); }
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
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
								href="javascript:void();">
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
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
								href="javascript:void();"><i class="fa fa-flag"></i></a>
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
									<img class="img-circle"
										src="assets/php/image.php?picture=profile&user_ID=<?php echo $_SESSION["user_ID"]; ?> "
										alt="profile-image">
								</span>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li class="dropdown-item user-details">
									<a href="myProfile.php">
										<div class="media">
											<div class="avatar"><img class="align-self-start mr-3"
													src="assets/php/image.php?picture=profile&user_ID=<?php echo $_SESSION["user_ID"]; ?> "
													alt="profile-image"> </div>
											<div class="media-body">
												<h6 class="mt-2 user-title">
													<?php echo $_SESSION['name']; ?>
												</h6>
												<p class="user-subtitle">
													<?php echo $_SESSION['email']; ?>
												</p>
											</div>
										</div>
									</a>
								</li>

								<li class="dropdown-divider"></li>
								<li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
								<li class="dropdown-divider"></li>
								<li class="dropdown-item"><a href="myProfile.php"><i class="icon-wallet mr-2"></i> Account
								</li>
								<li class="dropdown-divider"></li>
								<li class="dropdown-item"><a href="editProfile.php"><i class="icon-settings mr-2"></i>
										Setting</a></li>
								<a href="assets/php/logout.php">
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
											$user_picture = base64_encode($studyhub_member['picture']); // Assuming 'picture' is the correct BLOB column
								
											// Display only up to 4 members
											if ($counter < 4) {
												?>
												<div class="media align-items-center">
													<div class="rounded-circle" style="width: 50px; height: 50px; overflow: hidden;">
														<img src="data:image/jpeg;base64,<?php echo $user_picture; ?>"
															class="rounded-circle" style="width: 100%; height: auto;"
															alt="User Picture">
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
							
							<!--Start of Invitation Content-->
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<h5 class="mb-3">Discovery</h5>
											<div class="table-responsive">
												<table class="table table-hover table-striped">
													<tbody>
														<tr>
															<td>Struggling to find the right members for your group?<br>Let
																us assist you in finding potential group members<br>who match
																your preferences!</td>
														</tr>
													</tbody>
												</table>
											</div><br>
											<button class="btn btn-primary clickable-find">Get
												Started</button>
										</div>
									</div>
								</div>
							</div>
							<!--End of Invitation Content-->		

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

										<li class="nav-item">
											<a href="javascript:void();" data-target="#edit" data-toggle="pill"
												class="nav-link"><i class="icon-note"></i> <span
													class="hidden-xs">Edit</span></a>
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

																$query = "SELECT * FROM `study_session` WHERE studyhub_ID = '$studyhub_ID';";

																$result = mysqli_query($connection, $query);

																$count = 1; // Initialize count variable
																$hasRows = false; // Initialize $hasRows to false
															
																// Check if there are no studysessions or no rows found
																if (mysqli_num_rows($result) == 0) {
																	echo '<tr><td colspan="4">No study session found.</td></tr>';
																} else {
																	while ($row = mysqli_fetch_assoc($result)) {

																		// Convert the retrieved date to a timestamp
																		$sessionDate = strtotime($row['studysession_date']);

																		if (date("Y-m-d", $sessionDate) == date("Y-m-d")) {
																			if ($count < 4) {
																				echo '
																					<tr>
																					<th scope="row">' . $count . '</th>
																					<td>' . $row['studysession_name'] . '</td>
																					<td>' . $row['studysession_date'] . '</td>
																					<td><a href="studyhub-profile.php?application_ID=' . $row['studysession_id'] . '" class="btn btn-success">Join</a></td>
																					</tr>
																				';
																				$hasRows = true;
																			}
																		}

																		$count++; // Increment count for each row
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
																				<td>  <a href="' . ($userHasJoined ? 'view-session.php' : 'assets/php/process_joinStudySession.php') . '?studysession_id=' . $studysession_id . '" class="btn ' . ($userHasJoined ? 'btn-success' : 'btn-success') . '">' . $buttonLabel . '</a>
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
										<button onclick="showModal()">Show Modal</button>

										<div class="custom-modal" id="myCustomModal">
											<div class="modal-content">
												<div class="loader"></div>
											</div>
										</div>

										<script>
											function showModal() {
												var modal = document.getElementById('myCustomModal');
												modal.style.display = 'block';

												// Set a timeout to hide the modal after 5 seconds
												setTimeout(function() {
													modal.style.display = 'none';
												}, 5000); // 5000 milliseconds = 5 seconds
											}

										</script>
							
										<!--Start of First Tab-->
										<div class="tab-pane" id="edit">
											<form>
												<div class="form-group row">
													<label class="col-lg-3 col-form-label form-control-label">Study Hub
														Name</label>
													<div class="col-lg-9">
														<input class="form-control" type="text" id="studyhub_name"
															name="studyhub_name"
															value="<?php echo $_SESSION['studyhub_name']; ?>" <?php if ($_SESSION['user_ID'] != $user_ID)
																   echo 'readonly'; ?>>
													</div>
												</div>

												<div class="form-group row">
													<label
														class="col-lg-3 col-form-label form-control-label">Description</label>
													<div class="col-lg-9">
														<input class="form-control" type="text" id="studyhub_description"
															name="studyhub_description"
															value="<?php echo $_SESSION['studyhub_description']; ?>" <?php if ($_SESSION['user_ID'] != $user_ID)
																   echo 'readonly'; ?>>
													</div>
												</div>

												<div class="form-group row">
													<label
														class="col-lg-3 col-form-label form-control-label">Settings</label>
													<br>
													<div class="col-lg-9">
														<input type="radio" id="option1" name="setting"
															value="Open StudyHub" <?php echo ($_SESSION['setting'] === 'Open StudyHub' && $_SESSION['user_ID'] == $user_ID) ? 'checked' : '';
															echo ($_SESSION['user_ID'] != $user_ID) ? 'disabled' : ''; ?>>
														<label for="option1">Open StudyHub</label>
														&nbsp;&nbsp;
														<input type="radio" id="option2" name="setting"
															value="Close StudyHub" <?php echo ($_SESSION['setting'] === 'Close StudyHub' && $_SESSION['user_ID'] == $user_ID) ? 'checked' : '';
															echo ($_SESSION['user_ID'] != $user_ID) ? 'disabled' : ''; ?>>
														<label for="option2">Close StudyHub</label>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-3 col-form-label form-control-label">Change
														profile</label>
													<div class="col-lg-9">
														<form id="profilePictureForm" enctype="multipart/form-data"
															action="assets/php/process_editProfilePicture.php"
															method="post">
															<input type="file" name="profile_picture" id="profile_picture"
																style="display: none">
															<button type="button" id="chooseProfileFileButton"
																class="btn btn-primary">Choose Profile Picture</button>
															<input type="button" id="cropAndUploadProfile"
																class="btn btn-success" value="Crop and Upload"
																style="display: none">
														</form>
													</div>
												</div>

												<div class="form-group row">
													<label class="col-lg-3 col-form-label form-control-label">Change
														background</label>
													<div class="col-lg-9">
														<form id="bannerForm" enctype="multipart/form-data"
															action="assets/php/process_editBanner.php" method="post">
															<input type="file" name="banner_picture" id="banner_picture"
																style="display: none">
															<button type="button" id="chooseBannerFileButton"
																class="btn btn-primary">Choose Banner</button>
															<input type="button" id="cropAndUploadBanner"
																class="btn btn-success" value="Crop and Upload"
																style="display: none">
														</form>
													</div>
												</div>





											</form>

											<!-- Edit button - only available for application creator-->
											<?php
											if ($_SESSION['user_ID'] == $user_ID) {
												echo '<div style="display: flex; justify-content: center">';
												echo '<button class="btn btn-secondary" onclick="editStudyHub()"><iclass="fa fa-icon-class"></i> Save Changes</button>';
												echo '<a href="assets/php/delete_studyhub.php?studyhub_ID=' . $studyhub_ID . '" class="btn btn-danger" style="margin-left: 10px">Delete</a>';
												echo '</div>';
											}
											?>


										</div>
										<!--End of First Tab-->






									</div>



								</div>
							</div>
							
							<!--Start of Suggestion-->
							<div class="card profile-card-2" id = "suggestionContent" style="display: none;">
								<div class="card-body">
									<h5 class="mb-3">Suggested Members</h5>
									<div class="card" > <!-- Moved the ID here -->
										<div class="card-body" id="userDetails">
											<!-- Your content -->
										</div>
									</div>
									<div class="table-responsive">
										<table id="suggestionTable" class="table table-hover table-striped">
											<tbody>
												<!-- Table content will be inserted here -->
											</tbody>
										</table>
									</div>
								</div>
							</div>

							<!--End of Suggestion-->			

							

							<!--Start of Suggestion Modal-->
							<div id="modal-find" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;">
								<div class="modal-content" style="background: linear-gradient(45deg, #29323c, #485563); margin: 10% auto; padding: 20px; width: 50%; max-height: 70vh; overflow-y: auto; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); position: relative; color: #000;">
      								<span class="close" style="position: absolute; top: 0; right: 0; padding: 10px; cursor: pointer; color: #000;">&times;</span>
        
									<!-- Content for your modal goes here -->
									<center>
										<h3 style="color: #fff;">Find Members</h3>
									</center>

									<!-- Your additional content for adding badges -->
									<div class="tab-pane" id="findMember">
										<div class="row">
											<div class="col-md-12">
												<h5 class="mb-3"></h5>
												<div class="form-group">
													<div class="row justify-content-center"> <!-- Center aligning the row -->
														<input type="text" class="form-control col-lg-4 mr-2" name="addedSkills" id="addedSkills" placeholder="Input skill required">
														<button onclick="addSkills()" class="btn btn-primary" style="color: white;">Add</button>
													</div>
												</div>
												<br>

												<div class="form-group">
													<center id="badgeContainer">
													
													</center>
												</div>	



												<center>
													<button onclick="getFinalArray()" class="btn btn-success">Search</button>
												</center>
											</div>
										</div>
									</div>

								</div>
							</div>
							<!--End of Suggest Modal-->


						</div>
						<!--End of Second Column-->

						<div id="message"></div>

						<div class="crop-container">

							<!-- Crop Modal for Profile Picture -->
							<div class="modal fade" id="profileCropModal" tabindex="-1" role="dialog"
								aria-labelledby="profileCropModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content"  style="background: linear-gradient(45deg, #29323c, #485563); margin: 10% auto; padding: 20px; width: 70%; max-height: 70vh; overflow-y: auto; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); position: relative; color: #000;">
										<div class="modal-header">
											<h5 class="modal-title" id="profileCropModalLabel">Crop Profile Picture</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div
											class="modal-body text-center d-flex justify-content-center align-items-center">
											<canvas id="profileCroppedCanvas" width="110" height="110"></canvas>
											<div class ="cropper-container cropper-bg" touch-action="none" style="width:200px; height:100px;">

											</div>	
											
										</div>

										<div class="modal-footer justify-content-center">
											<button type="button" class="btn btn-secondary"
												data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary" id="confirmProfileCrop">Confirm
												Crop</button>
										</div>
									</div>
								</div>
							</div>

							<!-- Crop Modal for Banner -->
							<div class="modal fade" id="bannerCropModal" tabindex="-1" role="dialog"
								aria-labelledby="bannerCropModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content"  style="background: linear-gradient(45deg, #29323c, #485563); margin: 10% auto; padding: 20px; width: 70%; max-height: 70vh; overflow-y: auto; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); position: relative; color: #000;">
										<div class="modal-header">
											<h5 class "modal-title" id="bannerCropModalLabel">Crop Banner</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div
											class="modal-body text-center d-flex justify-content-center align-items-center">
											<canvas id="bannerCroppedCanvas" width="800" height="500"></canvas>
										</div>

										<div class="modal-footer justify-content-center">
											<button type="button" class="btn btn-secondary"
												data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary" id="confirmBannerCrop">Confirm
												Crop</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>



					<script>
						displayNotifications();
					

						// Function to create notification items with studyHub_ID data and associated details
						function addNotificationWithStudyHubDetails(studyHubDetails) {
							const notificationList = document.getElementById('notificationList');

							const li = document.createElement('li');
							li.className = 'dropdown-item';

							const row = document.createElement('div');
							row.className = 'row';

							const col2 = document.createElement('div');
							col2.className = 'col-2 d-flex align-items-center';

							const profileImg = document.createElement('span');
							profileImg.className = 'user-profile';

							// Creating an anchor tag around the circular image
							const imgLink = document.createElement('a');
							imgLink.href = `SB_profile.php?studyhub_ID=${studyHubDetails.studyhub_ID}`; // Set the URL with studyhub_ID parameter

							const img = document.createElement('img');
							img.className = 'img-circle'; // Apply a class for a circular shape (You may need to define this class in your CSS)
							img.style.width = '50px';
							img.style.height = '50px';
							if (studyHubDetails.profile_pic !== null) {
								img.src = `data:image/jpeg;base64, ${studyHubDetails.profile_pic}`;
							} else {
								img.src = 'https://via.placeholder.com/110x110';
							}
							img.alt = 'profile-image';

							imgLink.appendChild(img); // Add the image to the anchor tag
							col2.appendChild(imgLink); // Add the anchor tag to the column

							const col3 = document.createElement('div');
							col3.className = 'col-3';
							col3.innerHTML = `You have been invited to StudyHub ${studyHubDetails.studyhub_name}<br>
							
							<a href="javascript:void(0)" class="btn btn-success" onclick="approval(${studyHubDetails.studyhub_ID}, 'Accepted', '${studyHubDetails.invite_ID}')">Accept</a>
							<a href="javascript:void(0)" class="btn btn-danger" onclick="approval(${studyHubDetails.studyhub_ID}, 'Rejected', '${studyHubDetails.invite_ID}')">Reject</a>`;

							row.appendChild(col2);
							row.appendChild(col3);
							li.appendChild(row);

							notificationList.appendChild(li);
						}



						function displayNotifications(invite_ID) {
							fetch('assets/php/process_getInvitation.php')
								.then(response => response.json()) // Assuming the PHP script returns JSON data
								.then(dataToUse => {
									if (invite_ID) {
										const index = dataToUse.findIndex(detail => detail.invite_ID === invite_ID);
										if (index > -1) {
											dataToUse.splice(index, 1);
										}
									}

									const notificationList = document.getElementById('notificationList');
									notificationList.innerHTML = ''; // Clear previous content

									if (dataToUse.length === 0) {
									const existingSpan = document.getElementById('notificationCounter');
									if (existingSpan) {
										existingSpan.remove(); // Remove the existing span if it exists
									}

									const noInvitationMessage = document.createElement('li');
									noInvitationMessage.textContent = 'No new invitations yet';
									noInvitationMessage.style.padding = '10px';
									notificationList.appendChild(noInvitationMessage);
								} else {
									const notificationCount = dataToUse.length;

									let newSpan = document.getElementById('notificationCounter');
									if (!newSpan) {
										newSpan = document.createElement('span');
										newSpan.className = 'position-absolute top-0 end-0 badge rounded-circle bg-danger';
										newSpan.style.fontSize = '10px';
										newSpan.id = 'notificationCounter';
									}

									newSpan.textContent = notificationCount;

									const bellIcon = document.querySelector('.fa-bell-o');
									bellIcon.appendChild(newSpan);

									dataToUse.forEach(studyHubDetail => {
										addNotificationWithStudyHubDetails(studyHubDetail);
									});
								}

								})
								.catch(error => console.error('Error:', error));
						}





						function approval(studyHub_ID, answer, invite_ID) {
							var answerText = answer.toLowerCase();
							if (answerText === "accept") {
								answerText = answerText.slice(0, -2);
							} else {
								answerText = answerText.slice(0, -2);
							}
							if (confirm("Are you sure you want to " + answerText  +" this application?")) {
								$.ajax({
									url: 'assets/php/process_invitationResponse.php',
									method: 'POST',
									data: { studyHub_ID: studyHub_ID, status: answer },
									success: function(response) {
										// Handle the response from the PHP script
										console.log(response);
										if (answer == "Rejected")
											alert("Invitation has been rejected!");
										else
											alert("Invitation has been accepted!");
										
										// Display updated notifications
										displayNotifications(invite_ID);	
										<?php $_SESSION['count'] = 1; ?>
									},
									error: function(xhr, status, error) {
										// Handle the error
										console.log(error);
									}
								});
							}
						}


						
						// Get the "Find" span element
						var findSpan = document.querySelector(".clickable-find");

						// Get the add modal, close button, and modal content
						var findModal = document.getElementById("modal-find");
						var findModalCloseButton = findModal.querySelector(".close");
						var findModalContent = findModal.querySelector(".modal-content");
						
						// Function to display the add modal
						function showFindModal() {
							findModal.style.display = "block";
						}

						// Function to close the add modal
						function closeFindModal() {
							findModal.style.display = "none";
						}

						// Open the add modal when the "Add" span is clicked
						findSpan.addEventListener("click", showFindModal);

						// Close the add modal when the close button is clicked
						findModalCloseButton.addEventListener("click", closeFindModal);

						// Close the add modal if the background is clicked
						window.addEventListener("click", function(event) {
							if (event.target === findModal) {
								closeFindModal();
							}
						});

						// Prevent clicks inside the add modal content from closing the modal
						findModalContent.addEventListener("click", function(event) {
							event.stopPropagation();
						});


						var profileCropper;
						var bannerCropper;

						$('#chooseProfileFileButton').click(function () {
							$('#profile_picture').click();
						});

						$('#chooseBannerFileButton').click(function () {
							$('#banner_picture').click();
						});

						$('#profile_picture').change(function () {
							var input = this;
							if (input.files && input.files[0]) {
								var reader = new FileReader();
								reader.onload = function (e) {
									if (profileCropper) {
										profileCropper.replace(e.target.result);
									} else {
										profileCropper = new Cropper(document.getElementById('profileCroppedCanvas'), {
											aspectRatio: 1,
											viewMode: 2,
										});

										profileCropper.replace(e.target.result);
									}
									$('#profileCropModal').modal('show');
								};
								reader.readAsDataURL(input.files[0]);
							}
						});

						$('#banner_picture').change(function () {
							var input = this;
							if (input.files && input.files[0]) {
								var reader = new FileReader();
								reader.onload = function (e) {
									if (bannerCropper) {
										bannerCropper.replace(e.target.result);
									} else {
										bannerCropper = new Cropper(document.getElementById('bannerCroppedCanvas'), {
											aspectRatio: 16 / 9, // Set your desired aspect ratio for the banner image
											viewMode: 2,
										});

										bannerCropper.replace(e.target.result);
									}
									$('#bannerCropModal').modal('show');
								};
								reader.readAsDataURL(input.files[0]);
							}
						});

						$('#confirmProfileCrop').click(function () {
							if (profileCropper) {
								var canvas = profileCropper.getCroppedCanvas({ width: 110, height: 110 });
								var studyHub_ID = <?php echo $studyhub_ID; ?>;
								if (canvas) {
									canvas.toBlob(function (blob) {
										var formData = new FormData();
										formData.append('profile_picture', blob);
										formData.append('studyHub_ID', studyHub_ID);
										$.ajax({
											url: 'assets/php/process_editSB-Profile.php',
											method: 'POST',
											data: formData,
											processData: false,
											contentType: false,
											success: function (response) {
												if (response.imageData) {
													alert("Your profile picture is updated!");
													var newImageData = response.imageData;

													// Find the <img> element with the id 'profilePicture'
													var imgElement = document.getElementById('profilePicture');

													// Update the 'src' attribute of the <img> element with the new image data
													imgElement.src = "data:image/jpeg;base64," + newImageData;

													$('#profileCropModal').modal('hide');
												} else {
													// Handle the case where imageData is empty or null (e.g., show an error message)
													alert("Image data is empty or null. Failed to update image.");
												}
											}
										});
									});
								}
							}
						});

						$('#confirmBannerCrop').click(function () {
							if (bannerCropper) {
								var studyHub_ID = <?php echo $studyhub_ID; ?>;
								var canvas = bannerCropper.getCroppedCanvas({ width: 800, height: 500 }); // Set your desired dimensions for the banner image
								if (canvas) {
									canvas.toBlob(function (blob) {
										var formData = new FormData();
										formData.append('banner_picture', blob);
										formData.append('studyHub_ID', studyHub_ID); // Fetch and append studyHub_ID
										$.ajax({
											url: 'assets/php/process_editSB-Banner.php',
											method: 'POST',
											data: formData,
											processData: false,
											contentType: false,
											success: function (response) {
												if (response.imageData) {
													alert("Your banner picture is updated!");
													var newImageData = response.imageData;

													// Find the <img> element with the id 'bannerPicture'
													var imgElement = document.getElementById('bannerPicture');

													// Update the 'src' attribute of the <img> element with the new image data
													imgElement.src = "data:image/jpeg;base64," + newImageData;

													$('#bannerCropModal').modal('hide');
												} else {
													// Handle the case where imageData is empty or null (e.g., show an error message)
													alert("Image data is empty or null. Failed to update image.");
												}
											},
											error: function (xhr, status, error) {
												console.log(error);
											}
										});

									});
								}
							}
						});



						$('#profileCropModal, #bannerCropModal').on('hidden.bs.modal', function () {
							$('#profile_picture, #banner_picture').val('');
							if (profileCropper) {
								profileCropper.destroy();
							}
							if (bannerCropper) {
								bannerCropper.destroy();
							}
						});

						function editStudyHub() {
							var studyHubName = $("#studyhub_name").val();
							var studyHubDescription = $("#studyhub_description").val();
							var studyHub_ID = <?php echo $studyhub_ID; ?>;
							var selectedSetting = $("input[name='setting']:checked").val();

							$.ajax({
								url: 'assets/php/process_editStudyHub.php',
								method: 'POST',
								data: {
									studyHubName: studyHubName,
									studyHubDescription: studyHubDescription,
									studyHub_ID: studyHub_ID,
									selectedSetting: selectedSetting
								},
								success: function (response) {
									// Handle the response from the PHP script
									if (response === "success") {
										alert("Information has been updated!");

										var h5Element = document.querySelector('.card-title');
										var pElement = document.querySelector('.card-text');

										// Update the text inside the <h5> element
										h5Element.textContent = studyHubName;
										pElement.textContent = studyHubDescription;

									} else {
										alert("Failed to update information.");
									}
								},
								error: function (xhr, status, error) {
									// Handle the error
									console.log(error);
								}
							});



						}

						let addedSkillsArray = [];

						function addSkills() {
							var skillValue = document.getElementById("addedSkills").value;

							if (skillValue.trim() !== '') {
								// Create a new badge element
								var newBadge = document.createElement('a');
								newBadge.textContent = skillValue;
								newBadge.classList.add('badge', 'badge-dark', 'badge-pill', 'mr-2');
								newBadge.style.color = 'white';

								// Find the container to append the new badge
								var badgeContainer = document.getElementById('badgeContainer');

								// Append the new badge to the container
								badgeContainer.appendChild(newBadge);

								// Push the skill into the array
								addedSkillsArray.push(skillValue);

								// Clear the input field after adding
								document.getElementById("addedSkills").value = '';
							}
						}

						function getFinalArray() {
							console.log(addedSkillsArray);
							// Perform an AJAX request to send the array to a PHP file
							var xhr = new XMLHttpRequest();
							xhr.open("POST", "assets/php/algorithmicMatching.php");
							xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
							xhr.send(JSON.stringify({ skillsArray: addedSkillsArray }));

							xhr.onload = function () {
								if (xhr.status === 200) {
									console.log("Array sent successfully!");

									try {
										var response = JSON.parse(xhr.responseText);
										console.log("Parsed JSON response: ", response);

										// Call a function to display the results on the page
										displayResults(response);

										var noSubjectsFound = document.getElementById("suggestionContent");
										
										noSubjectsFound.style.display = "block";
										
									} catch (error) {
										console.error("Error parsing JSON:", error);
										console.log("Response content:", xhr.responseText);
										// Handle the error or incorrect response here
									}
								} else {
									console.error("Error sending array");
									// Handle the error or incorrect response here
								}
							};
						}


						function displayResults(data) {
							var contentContainer = document.getElementById('userDetails'); // Assuming 'userDetails' is the ID of the container div
    						contentContainer.innerHTML = '';
							if (data && data.length > 0) {
								data.forEach(function (user) {
									var skillsList = user.matched_skills.join(', '); // Joined matched skills into a string
									var matchPercentage = user.match_percentage.toFixed(2); // Limiting to two decimal places

									var userContent = `
									<hr>
									

									<div class="row">
										<div class ="row align-items-start">							
											<div class="col-lg-2">
												${user.imageData !== null && user.imageData !== '' ? `<img src="data:image/jpeg;base64, ${user.imageData}" width="110" height="110">` : `<img src="https://via.placeholder.com/110x110">`}
													
											</div>
										</div>
										<div class="col-lg-4 align-items-center">
											<h6>Name</h6>
											<p>${user.name}</p>
											<hr>
											<h6>Email</h6>
											<p>${user.email}</p>
										</div>

										<div class="col-lg-4 align-items-center">
											<h6>Skills Matched</h6>
											<p>${skillsList}</p>
											<hr>
											<h6>Accuracy Percentage</h6>
											<p>${matchPercentage}%</p>
										</div>

										<div class="col-lg-2 d-flex align-items-center justify-content-center">
											<button class="btn btn-success" onclick="sendInvitation('${user.user_ID}')">
												Invite
											</button>

										</div>
									</div>
								`;
									contentContainer.insertAdjacentHTML('beforeend', userContent);
								});
							} else {
								var noResultsContent = `
									<p>No matching users found.</p>
								`;
								contentContainer.innerHTML = noResultsContent;
							}
						}

						function sendInvitation(user_ID){
							var studyHub_ID = <?php echo $studyhub_ID; ?>;

							$.ajax({
								url: 'assets/php/process_sendInvitation.php',
								method: 'POST',
								data: {
									user_ID: user_ID,
									studyHub_ID: studyHub_ID
								},
								success: function (response) {
									// Handle the response from the PHP script
									if (response === "success") {
										alert("Invitation has been sent!");

									} else {
										alert("Failed to send the invitation");
									}
								},
								error: function (xhr, status, error) {
									// Handle the error
									console.log(error);
								}
							});
						}






					</script>

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

							<ul class="switcher">a
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