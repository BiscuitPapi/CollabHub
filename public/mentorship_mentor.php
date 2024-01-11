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
		<link href="../assets/css/mentorship.css" rel="stylesheet" />
		<link rel="stylesheet" href="../assets/css/modally.css">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
					<span class="badge badge-primary" style="font-size: 15px;"><i class="fa fa-user"></i> Mentor</span>


					<div class="row mt-3">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
										<li class="nav-item">
											<a href="javascript:void();" data-target="#profile" data-toggle="pill"
												class="nav-link active"><i class="zmdi zmdi-account-box-mail"></i> <span
													class="hidden-xs">My Mentorship Profile</span></a>
										</li>
										<li class="nav-item">
											<a href="javascript:void();" data-target="#pendingApplication"
												data-toggle="pill" class="nav-link"><i class="zmdi zmdi-assignment-o"></i>
												<span class="hidden-xs">Applications</span></a>
										</li>

										<li class="nav-item">
											<a href="javascript:void();" data-target="#inviteTab" data-toggle="pill"
												class="nav-link"><i class="zmdi zmdi-accounts-add"></i>
												<span class="hidden-xs">Invite</span></a>
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
																	<img class="profile"
																		src="../assets/php/mentorship/image.php?picture=profile&user_ID=<?php echo $_SESSION["user_ID"]; ?>"
																		alt="profile-image">
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
																	<div
																		class="d-flex justify-content-between align-items-center">
																		<h6 class="mb-0">Subject Interest</h6>
																		<span class="d-flex">
																			<span
																				class="badge badge-success clickable-add mr-2"
																				style="cursor: pointer;"><i></i> +
																				Add</span>
																			<span
																				class="badge badge-danger clickable-delete"
																				style="cursor: pointer;"><i></i> -
																				Delete</span>
																		</span>
																	</div>


																	<br>
																	<div class="badge-wrapper d-flex flex-wrap"
																		id="badge-container"></div>
																	<div id="no-subjects-found" style="display: none;">
																		No subjects found for this user.
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

																			echo '<div class="badge-wrapper d-flex flex-wrap" id="badge-container">'; // Use d-flex to arrange the badges horizontally
																
																			$count = 0;
																			foreach ($subjectsArray as $subject) {
																				$subject = trim($subject); // Remove any leading/trailing spaces
																				if (!empty($subject)) {
																					if ($count % 4 == 0 && $count > 0) {
																						echo '</div>'; // Close the previous row
																						echo '<div class="badge-wrapper d-flex flex-wrap" style="margin-top: 10px;">'; // Open a new row
																					}
																					echo "<a class='badge badge-dark badge-pill mr-2'>$subject</a>";
																					$count++;
																				}
																			}

																			// Close the last badge-wrapper
																			echo '</div>';
																		}




																	} else {
																		echo "";
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
																					<input type="text" class="form-control"
																						name="addedSubject"
																						id="addedSubject" placeholder=""
																						required>
																				</div>

																				<br>
																				<center><button onclick="addNewBadge()"
																						class="btn btn-success">Add
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
																							echo "<center><button class='btn btn-primary' onclick='saveChanges()'>Save Changes</button></center>";

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
															<div class="card-title">My Mentees</div>
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

																		$query = "SELECT * FROM mentorship WHERE mentor_ID = '{$_SESSION['user_ID']}' and status = 'Approved'";
																		$result = mysqli_query($connection, $query);

																		$count = 1; // Initialize count variable
																	
																		// Check if there are no mentees or no rows found
																		if (mysqli_num_rows($result) == 0) {
																			echo '<tr><td colspan="4">No mentees found.</td></tr>';
																		} else {
																			while ($row = mysqli_fetch_assoc($result)) {
																				$mentee_ID = $row['mentee_ID'];
																				$query_2 = "SELECT * FROM user WHERE user_ID = '{$mentee_ID}'";
																				$result_2 = mysqli_query($connection, $query_2);
																				$row_2 = mysqli_fetch_assoc($result_2);

																				// Output each row of the table
																				echo '
																						<tr>
																							<th scope="row">' . $count . '</th>
																							<td>' . $row_2['name'] . '</td>
																							<td>' . $row['dateCreated'] . '</td>
																							<td>
																								<a href="myProfile.php?user_ID=' . $row_2['user_ID'] . '" class="btn btn-info">View</a>
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


										<!-- START OF MY PENDING APPLICATIONS  -->
										<div class="tab-pane" id="pendingApplication" style="min-height:345px;">
											<div class="row">
												<div class="col-lg-12">
													<div class="row"
														style="justify-content: center; align-items: center; margin-bottom: 20px;">
														<button class="btn btn-primary" id="pendingList-button"
															onclick="togglePage('pendingList')">Pending</button>
														<button class="btn btn-dark" id="rejectedList-button"
															onclick="togglePage('rejectedList')">Rejected
														</button>
													</div>
													<div class="card" id="pendingList">
														<div class="card-body">
															<div class="card-title">Pending Applications</div>
															<div class="table-responsive">
																<table class="table table-hover">
																	<thead>
																		<tr>
																			<th scope="col">#</th>
																			<th scope="col">Applicant</th>
																			<th scope="col" style="text-align: center;">
																				Application Date</th>
																			<th scope="col" style="text-align: center;">
																				Rating</th>
																			<th scope="col" colspan="2"
																				style="text-align: center;">Action</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																		include("../assets/php/connection.php");

																		$query = "SELECT * FROM mentorship WHERE mentor_ID = '{$_SESSION['user_ID']}' and status = 'Pending'";
																		$result = mysqli_query($connection, $query);

																		$count = 1; // Initialize count variable
																	
																		// Check if there are no pending applications
																		if (mysqli_num_rows($result) == 0) {
																			echo '<tr><td colspan="5">No pending applications found.</td></tr>';
																		} else {
																			while ($row = mysqli_fetch_assoc($result)) {
																				$mentee_ID = $row['mentee_ID'];
																				$query_2 = "SELECT * FROM user WHERE user_ID = '{$mentee_ID}'";
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
																						<td><a href="viewProfile.php?user_ID=' . $row_2['user_ID'] . '">';

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
																						' . $row_2['name'] . '</a>
																					</td>

																						<td style="text-align: center;">' . $row['dateCreated'] . '</td>
																						<td style="text-align: center;">' . $row_2['rating'] . '</td>
																						<td style="text-align: center;">
																							<a href="" class="btn btn-success" onclick="approvalMM(' . $row['mt_ID'] . ', \'Approved\')">Approve</a>
																							<a href="" class="btn btn-danger" onclick="approvalMM(' . $row['mt_ID'] . ', \'Rejected\')">Reject</a>

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
													<div class="card" id="rejectedList" style="display: none;">
														<div class="card-body">
															<div class="card-title">Rejected Applications</div>
															<div class="table-responsive">
																<table class="table table-hover">
																	<thead>
																		<tr>
																			<th scope="col">#</th>
																			<th scope="col">Applicant</th>
																			<th scope="col" style="text-align: center;">
																				Application Date</th>
																			<th scope="col" style="text-align: center;">
																				Rating</th>
																			<th scope="col" colspan="1"
																				style="text-align: center;">Status</th>
																			<th scope="col" colspan="1"
																				style="text-align: center;">Action</th>

																		</tr>
																	</thead>
																	<tbody>
																		<?php
																		include("../assets/php/connection.php");

																		$query = "SELECT * FROM mentorship WHERE mentor_ID = '{$_SESSION['user_ID']}' and status = 'Rejected'";
																		$result = mysqli_query($connection, $query);

																		$count = 1; // Initialize count variable
																	
																		// Check if there are no rejected applications
																		if (mysqli_num_rows($result) == 0) {
																			echo '<tr><td colspan="5">No rejected applications found.</td></tr>';
																		} else {
																			while ($row = mysqli_fetch_assoc($result)) {
																				$mentee_ID = $row['mentee_ID'];
																				$query_2 = "SELECT * FROM user WHERE user_ID = '{$mentee_ID}'";
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
																					<td>
																						<a href="viewProfile.php?user_ID=' . $row_2['user_ID'] . '">';

																				if ($tempPicture === null) {
																					echo '
																								<img src="https://via.placeholder.com/110x110" alt="profile-image" class="align-self-start mr-3 rounded-circle" id="smallProfilePicture_2" style="width: 50px; height: 50px;">
																							';
																				} else {
																					echo '
																							<img src="data:image/jpeg;base64,' . $tempPicture . '" alt="profile-image" class="align-self-start mr-3 rounded-circle" id="smallProfilePicture_2" style="width: 50px; height: 50px;">
																						';
																				}

																				echo $row_2['name'] . '</a>
																					</td>
																					<td style="text-align: center;">' . $row['dateCreated'] . '</td>
																					<td style="text-align: center;">' . $row_2['rating'] . '</td>
																					<td style="text-align: center;">
																						<span class="badge badge-danger"><i class="fa fa-cog"></i> ' . $row['status'] . '</span>
																					</td>
																					<td style="text-align: center;">
																					<button onclick="resetApplicant(' . $row["mt_ID"] . ')"><span class="badge"><i class="zmdi zmdi-chart-donut text-success"></i>Reset</span></button>
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
										</div> <!-- ROW ENDS HERE -->
										<!-- END OF MY PENDING APPLICATIONS  -->

										<!-- START OF INVITE-->
										<div class="tab-pane" id="inviteTab" style="min-height:345px;">

											<div class="row">
												<div class="col-4">
													<!-- Start of Suggestion -->
													<div class="card profile-card-2" id="suggestionContent"
														style="min-height: 300px;">
														<div class="card-body">

															<h5 class="mb-3">Search Members</h5>


															<div class="form-group">
																<div class="row">
																	<div class="col-8">
																		<!-- Center aligning the row -->
																		<div class="autocomplete" style="width: 200px;">
																			<input id="myInput" type="text" name="myCountry"
																				placeholder="Input skill required"
																				style="width: 100%;">
																		</div>
																	</div>
																	<div class="col-4">
																		<div class="text-center">
																			<button onclick="addSkills()"
																				class="btn btn-primary"
																				style="color: white;">Add</button>
																		</div>
																	</div>

																</div>
																<br>


															</div>

															<div class="badge-wrapper d-flex flex-wrap" id="badgeContainer">
															</div>





															<br>

															<!-- Suggestions dropdown container -->
															<div class="form-group" id="suggestions-container">
															</div>

															<center>
																<button onclick="getFinalArray()"
																	class="btn btn-success">Search</button>
															</center>

															<div class="custom-modal" id="myCustomModal">
																<div class="modal-content-1">
																	<center>
																		<div class="loader"></div>
																	</center>

																	<p id="loadingMessage">Searching for potential
																		members...</p>
																</div>
															</div>

														</div>
													</div>
													<!-- End of Suggestion -->
												</div>

												<div col="8">
													<!-- Start of Suggestion -->
													<div class="card profile-card-2" id="suggestionContent"
														style="min-height: 300px;min-width: 715px;">
														<div class="card-body">
															<h5 class="mb-3">Suggested Members</h5>
															<div class="card"> <!-- Moved the ID here -->
																<div class="card-body" id="userDetails">
																	Not searching is made yet.
																</div>
															</div>
															<div class="table-responsive">
																<table id="suggestionTable"
																	class="table table-hover table-striped">
																	<tbody>
																		<!-- Table content will be inserted here -->
																	</tbody>
																</table>
															</div>
														</div>
													</div>
													<!-- End of Suggestion -->
												</div>
											</div>

										</div>
										<!-- END OF INVITE-->
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
		</div>
		<!--End content-wrapper-->

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
		<script src="../assets/js/inviteMM.js"></script>
		<script src="../assets/js/MM.js"></script>
		<script src="../assets/js/searchAPI.js"></script>
		<script>
			displayNotifications();
		</script>

	</body>

	</html>

	<?php
}
?>