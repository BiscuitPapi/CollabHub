<?php
session_start();
// Check if the session variable exists
if (!isset($_SESSION['user_ID'])) {
	// Redirect to the login page
	header("Location: index.php");
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
		<title>Mentorship</title>
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
		<link rel="stylesheet" href="../assets/css/modally.css">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
				font-size: 18px;
				/* Adjust the font size to make the X button bigger */
				margin-left: 5px;
				/* Add some spacing between the input field and the X button */
				padding: 4px 8px;
				text-decoration: none;
				margin-left: 5px;
				/* Add some spacing between the input field and the X button */
				margin-right: -10px;
				/* Move the X button towards the right edge of the badge */
			}

			.badge-pill {
				display: flex;
				align-items: center;
			}

			.badge-input {
				width: 60%;
				/* Adjust the width as per your preference */
				display: inline-block;
				vertical-align: middle;
			}

			.badge-name {
				margin-right: 5px;
				/* Add some spacing between the badge name and input field */
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

			.img-circle {
				border-radius: 50%;
				object-fit: cover;
				/* Maintain image aspect ratio */
				/* Add any additional styles or adjustments as needed */
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
			<!--Start Content Wrapper-->
			<div class="content-wrapper">
				<div class="container-fluid">
					<span class="badge badge-success" style="font-size: 15px;"><i class="fa fa-user"></i> Mentee</span>


					<div class="row mt-3">


						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
										<li class="nav-item">
											<a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="zmdi zmdi-account-box-mail"></i> <span class="hidden-xs">My Mentorship Profile</span></a>
										</li>
										<li class="nav-item">
											<a href="javascript:void();" data-target="#myApplication" data-toggle="pill" class="nav-link"><i class="zmdi zmdi-assignment-o"></i> <span class="hidden-xs">My Applications</span></a>
										</li>
										<li class="nav-item">
											<a href="javascript:void();" data-target="#listMentors" data-toggle="pill" class="nav-link"><i class="zmdi zmdi-account-add"></i> <span class="hidden-xs">List of Mentors</span></a>
										</li>
									</ul>


									<div class="tab-content p-3">
										<!-- START OF MY MENTORSHIP PROFILE -->
										<div class="tab-pane active" id="profile">
											<div class="row">
												<!-- FIRST COLUMN -->
												<div class="col-lg-4">
													<div class="card">
														<div class="card-body">
															<div class="card-title">My Information</div>
															<div class="row">
																<div class="col-lg-5">
																	<img class="profile" src="../assets/php/mentorship/image.php?picture=profile&user_ID=<?php echo $_SESSION["user_ID"]; ?>" alt="profile-image">
																</div>

																<div class="col-lg-6">
																	<h6>Name</h6>
																	<p>
																		<?php echo $_SESSION["name"]; ?>
																	</p>

																	<hr>

																	<h6>Email</h6>

																	<p>
																		<?php echo $_SESSION["email"]; ?>
																	</p>
																</div>
															</div>

															<div class="row">
																<div class="col-lg-12">
																	<hr>
																	<div class="d-flex justify-content-between align-items-center">
																		<h6 class="mb-0">Subject Interest</h6>
																		<span class="d-flex">
																			<span class="badge badge-success clickable-add mr-2" style="cursor: pointer;"><i></i> + Add</span>

																			<span class="badge badge-danger clickable-delete" style="cursor: pointer;"><i></i> -
																				Delete</span>
																		</span>
																	</div>


																	<br>
																	<div class="badge-wrapper d-flex flex-wrap" id="badge-container"></div>
																	<div id="no-subjects-found" style="display: none;">

																	</div>
																	<?php

																	include("../assets/php/connection.php");

																	if (isset($_SESSION["user_ID"])) {
																		// Assuming you have already established a database connection

																		// Retrieve subjects for the logged-in user
																		$user_ID = $_SESSION["user_ID"];
																		$stmt = $connection->prepare("SELECT subjects FROM user WHERE user_ID = ?");
																		$stmt->bind_param("i", $user_ID);
																		$stmt->execute();
																		$stmt->bind_result($currentSubjects);
																		$stmt->fetch();
																		$stmt->close();

																		// Check if subjects were retrieved and display them
																		if (!empty($currentSubjects)) {
																			$subjectsArray = explode("###", $currentSubjects);

																			// Output badge container and loop through subjects
																			echo '<div class="badge-wrapper d-flex flex-wrap" id="badge-container">';

																			foreach ($subjectsArray as $subject) {
																				$subject = trim($subject); // Remove any leading/trailing spaces
																				if (!empty($subject)) {
																					echo "<a class='badge badge-dark badge-pill mr-2'>$subject</a>";
																				}
																			}

																			// Close the badge container
																			echo '</div>';
																		} else {
																			echo "No subjects found for this user.";
																		}
																	}

																	?>
																</div>
															</div>

															<!-- ADD SUBJECT -->
															<div id="modal" class="modal">
																<div class="modal-content">
																	<span class="close">&times;</span>
																	<!-- Content for your modal goes here -->
																	<center>
																		<h3>Add Subject</h3>
																	</center>

																	<!-- Your additional content for adding badges -->
																	<div class="tab-pane" id="addSubject">
																		<div class="row">
																			<div class="col-md-12">
																				<h5 class="mb-3"></h5>
																				<div class="form-group">
																					<label for="input-1">Subject
																						Name</label>
																					<input type="text" class="form-control" name="addedSubject" id="addedSubject" placeholder="" required>
																				</div>

																				<br>
																				<center><button onclick="addNewBadge()" class="btn btn-success">Add
																						Subject</button></center>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<!-- END OF ADD SUBJECT -->

															<!-- DELETE SUBJECT -->
															<div id="delete-modal" class="modal">
																<div class="modal-content">
																	<span class="close">&times;</span>
																	<!-- Content for your modal goes here -->
																	<center>
																		<h3>Delete Subject</h3>
																	</center>
																	<br>
																	<!-- Your additional content for adding badges -->
																	<div class="tab-pane" id="deleteSubject">
																		<div class="row">
																			<div class="col-md-12">
																				<div class="media align-items-center">

																					<div class="progress-wrapper">
																						<?php
																						include("../assets/php/connection.php");
																						$user_ID = $_SESSION["user_ID"];
																						$stmt = $connection->prepare("SELECT subjects FROM user WHERE user_ID = ?");
																						$stmt->bind_param("i", $user_ID);
																						$stmt->execute();
																						$stmt->bind_result($currentSubjects);
																						$stmt->fetch();
																						$stmt->close();

																						if (!empty($currentSubjects)) {
																							$subjectsArray = explode("###", $currentSubjects);

																							echo '<div class="badge-wrapper d-flex flex-wrap justify-content-center">'; // Center the subjects and allow them to wrap

																							$count = 0;
																							foreach ($subjectsArray as $subject) {
																								$subject = trim($subject); // Remove any leading/trailing spaces
																								if (!empty($subject)) {
																									if ($count % 2 == 0 && $count > 0) {
																										echo '<div class="w-100" style="margin-top: 10px;"></div>'; // Create a new row
																									}

																									echo "<div class='d-flex align-items-center'>";
																									echo "<input type='text' class='form-control badge-input' style='width: 50%' value='" . $subject . "' readonly>";

																									// Add the data attribute to store the subject's value
																									echo "<button class='delete-button' data-subject='" . $subject . "' onclick='deleteBadge(this)'>✖</button>";

																									echo "</div>";

																									$count++;
																								}
																							}

																							echo '</div>';
																							echo "<br><br>";

																							// Display the "Save Changes" button
																							echo '<center><button onclick="saveChanges()" class="btn btn-primary">Save Changes</button></center>';
																						} else {
																							echo "No subjects found for this user.";
																						}
																						?>

																					</div>
																				</div>

																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<!-- END OF DELETE SUBJECT -->
														</div>
													</div>
												</div>


												<!-- SECOND COLUMN -->
												<div class="col-lg-8">
													<div class="card" style="min-height: 320px;">
														<div class="card-body">
															<div class="card-title">My Mentors</div>
															<div class="table-responsive">
																<table class="table table-hover">
																	<thead>
																		<tr>
																			<th scope="col">#</th>
																			<th scope="col">Mentee</th>
																			<th scope="col">Date Joined</th>
																			<th scope="col">Action</th>
																		</tr>
																	</thead>

																	<tbody>
																	<?php
																		include("../assets/php/connection.php");
																		
																		$query = "SELECT * FROM mentorship WHERE mentee_ID = '{$_SESSION['user_ID']}' and status = 'Approved'";
																		$result = mysqli_query($connection, $query);

																		$count = 1; // Initialize count variable

																		// Check if there are no mentees or no rows found
																		if (mysqli_num_rows($result) == 0) {
																			echo '<tr><td colspan="4">No mentors found.</td></tr>';
																		} else {
																			while ($row = mysqli_fetch_assoc($result)) {
																				$mentor_ID = $row['mentor_ID'];
																				$query_2 = "SELECT * FROM user WHERE user_ID = '{$mentor_ID}'";
																				$result_2 = mysqli_query($connection, $query_2);
																				$row_2 = mysqli_fetch_assoc($result_2);

																				// Store the profile picture properly as a base64-encoded string
																				$tempPicture = $row_2['picture'];
																				if ($tempPicture !== null) {
																					$tempPicture = base64_encode($tempPicture);
																				} else {
																					$tempPicture = null;
																				}


																				// Output each row of the table
																				echo '
																					<tr>
																						<th scope="row">' . $count . '</th>
																						<td>';

																				if ($tempPicture === null) {
																					echo '
																								<img src="https://via.placeholder.com/110x110" alt="profile-image" class="align-self-start mr-3 rounded-circle" id="smallProfilePicture_2" style="width: 50px; height: 50px;">
																							';
																				} else {
																					echo '
																							
																								<img src="data:image/jpeg;base64,' . $tempPicture . '" alt="profile-image" class="align-self-start mr-3 rounded-circle" id="smallProfilePicture_2" style="width: 50px; height: 50px;">
																							';
																				}

																				echo '
																							' . $row_2['name'] . '
																						</td>
																						<td>' . $row['dateCreated'] . '</td>
																						<td>
																							<a href="viewProfile.php?user_ID=' . $row_2['user_ID'] . '" class="btn btn-info">View</a>
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
											</div> <!-- ROW ENDS HERE -->
										</div>
										<!-- END OF MY MENTORSHIP PROFILE -->


										<!-- START MY APPLICATIONS -->
										<div class="tab-pane" id="myApplication">
											<div class="row">
												<div class="col-lg-12">
													<div class="card">
														<div class="card-body">
															<div class="card-title">My Applications</div>
															<div class="table-responsive">
																<table class="table table-hover">
																	<thead>
																		<tr>
																			<th scope="col">#</th>
																			<th scope="col">Mentor</th>
																			<th scope="col" style="text-align: center;">
																				Application Date</th>
																			<th scope="col" style="text-align: center;">
																				Status</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																		include("../assets/php/connection.php");

																		$query = "SELECT * FROM mentorship WHERE mentee_ID = '{$_SESSION['user_ID']}' and status = 'Approved'";
																		$result = mysqli_query($connection, $query);

																		$count = 1; // Initialize count variable

																		// Check if there are no mentees or no rows found
																		if (mysqli_num_rows($result) == 0) {
																			echo '<tr><td colspan="4">No mentors found.</td></tr>';
																		} else {
																			while ($row = mysqli_fetch_assoc($result)) {
																				$mentor_ID = $row['mentor_ID'];
																				$query_2 = "SELECT * FROM user WHERE user_ID = '{$mentor_ID}'";
																				$result_2 = mysqli_query($connection, $query_2);
																				$row_2 = mysqli_fetch_assoc($result_2);

																				// Store the profile picture properly as a base64-encoded string
																				$tempPicture = $row_2['picture'];
																				if ($tempPicture !== null) {
																					$tempPicture = base64_encode($tempPicture);
																				} else {
																					$tempPicture = null;
																				}


																				// Output each row of the table
																				echo '
																					<tr>
																						<th scope="row">' . $count . '</th>
																						<td>';

																				if ($tempPicture === null) {
																					echo '
																								<img src="https://via.placeholder.com/110x110" alt="profile-image" class="align-self-start mr-3 rounded-circle" id="smallProfilePicture_2" style="width: 50px; height: 50px;">
																							';
																				} else {
																					echo '
																							
																								<img src="data:image/jpeg;base64,' . $tempPicture . '" alt="profile-image" class="align-self-start mr-3 rounded-circle" id="smallProfilePicture_2" style="width: 50px; height: 50px;">
																							';
																				}

																				echo '
																							' . $row_2['name'] . '
																						</td>
																						<td>' . $row['dateCreated'] . '</td>
																						<td>
																							<a href="viewProfile.php?user_ID=' . $row_2['user_ID'] . '" class="btn btn-info">View</a>
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
										<!-- END OF MY APPLICATIONs -->


										<!-- START OF LIST OF MENTOR -->
										<div class="tab-pane" id="listMentors">
											<div class="row">
												<div class="col-lg-12">
													<div class="card">
														<div class="card-body">
															<h5 class="card-title">List of Mentors</h5>
															<div class="table-responsive ">
																<table class="table table-hover">
																	
																	<tbody>
																		<?php

																		include("../assets/php/connection.php");

																		$query = "SELECT u.picture, u.user_ID, u.name, u.rating, COUNT(CASE WHEN m.status = 'Approved' THEN m.Mentee_ID END) AS numberOfMentees
																				FROM user u
																				LEFT JOIN mentorship m ON u.user_ID = m.Mentor_ID
																				WHERE u.mentorshipStatus = 'Mentor'
																				GROUP BY u.user_ID, u.name, u.rating";

																		$result = mysqli_query($connection, $query);

																		$count = 1; // Initialize count variable


																		if (mysqli_num_rows($result) > 0) {
																			// Output the table structure
																			echo '
																					<table class="table table-hover">
																						<thead>
																							<tr>
																								<th scope="col">#</th>
																								<th scope="col">Name</th>
																								<th scope="col" style="text-align: center;">Number of Mentees</th>
																								<th scope="col" style="text-align: center;">Rating</th>
																								<th scope="col" style="text-align: center;">Action</th>
																							</tr>
																						</thead>
																						<tbody>
																					';


																			// Output each row of the table
																			while ($row = mysqli_fetch_assoc($result)) {
																				// Store the profile picture properly as a base64-encoded string
																				$tempPicture = $row['picture'];
																				if ($tempPicture !== null) {
																					$tempPicture = base64_encode($tempPicture);
																				} else {
																					$tempPicture = null;
																				}
																		?>
																				<tr>
																					<th scope="row">
																						<?php echo $count; ?>
																					</th>
																					<td>
																						<?php
																						if ($tempPicture === null) {
																							echo '<img src="https://via.placeholder.com/110x110" alt="profile-image" class="align-self-start mr-3 rounded-circle" id="smallProfilePicture_2" style="width: 50px; height: 50px;">';
																						} else {
																							echo '<img src="data:image/jpeg;base64,' . $tempPicture . '" alt="profile-image" class="align-self-start mr-3 rounded-circle" id="smallProfilePicture_2" style="width: 50px; height: 50px;">';
																						}
																						echo $row['name'];
																						?>
																					</td>
																					<td style="text-align: center;">
																						<?php echo $row['numberOfMentees']; ?>
																					</td>
																					<td style="text-align: center;">
																						<?php echo $row['rating']; ?>
																					</td>
																					<td style="text-align: center;">
																						<a href="viewProfile.php?user_ID=<?php echo $row['user_ID']; ?>" class="btn btn-info">View</a>
																						<?php
																						$checkQuery = "SELECT * FROM mentorship WHERE mentor_ID = '{$row['user_ID']}' AND mentee_ID = '{$_SESSION['user_ID']}'";
																						$resulty = mysqli_query($connection, $checkQuery);

																						if ($resulty) {
																							// Check if a row exists in the result set
																							if (mysqli_num_rows($resulty) > 0) {
																								// Do nothing or add additional logic if needed
																							} else if (mysqli_num_rows($resulty) == 0) {
																								echo '<a href="#" class="btn btn-success" onclick="apply(' . $row['user_ID'] . '); return false;">Apply</a>';
																							}
																						}
																						?>
																					</td>
																				</tr>
																		<?php
																				$count++; // Increment count for each row
																			}



																			// Close the table structure
																			echo '
																						</tbody>
																					</table>
																					';
																		} else {
																			echo "No mentors found.";
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

											</div> <!-- END OF ROW -->
										</div>
										<!-- END OF LIST OF MENTOR -->




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
			</div>
			<!--End content-wrapper-->
			<script>

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
		<script src="../assets/js/notifications.js"></script>
		<script src="../assets/js/MM.js"></script>
		<script>
			displayNotifications();
		</script>

	</body>

	</html>

<?php
}
?>