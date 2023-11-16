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
		<title>Mentorship</title>
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
		<link rel="stylesheet" href="assets/css/modally.css">
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
									<img class="img-circle" src="assets/php/image.php?picture=profile&user_ID=<?php echo $_SESSION["user_ID"];?> " alt="profile-image">	
								</span>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li class="dropdown-item user-details">
									<a href="myProfile.php">
										<div class="media">
											<div class="avatar">
												<img class="align-self-start mr-3" src="assets/php/image.php?picture=profile&user_ID=<?php echo $_SESSION["user_ID"];?> " alt="profile-image">	
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
			<!--Start Content Wrapper-->
			<div class="content-wrapper">
				<div class="container-fluid">
				<span class="badge badge-success" style="font-size: 15px;"><i class="fa fa-user"></i>  Mentee</span>
			

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
																<div class="col-lg-6">
																	<img class="profile" src="assets/php/image.php?picture=profile&user_ID=<?php echo $_SESSION["user_ID"];?>" alt="profile-image">
																</div>

																<div class="col-lg-6">
																	<h6>Name</h6>
																	<p>
																		<?php echo $_SESSION["name"];?>
																	</p>
																	
																	<hr>

																	<h6>Email</h6>
																	
																	<p>
																		<?php echo $_SESSION["email"];?>
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
																			<span class="badge badge-danger clickable-delete" style="cursor: pointer;"><i></i> - Delete</span>
																		</span>
																	</div>
																	

																	<br>
																	<div class="badge-wrapper d-flex flex-wrap" id="badge-container"></div>
																	<div id="no-subjects-found" style="display: none;">
																		No subjects found for this user.
																	</div>
																	<?php 
																		
																		include("assets/php/connection.php");
																		
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
																				echo "User is not logged in.";
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
																	<center><h3>Add Subject</h3></center>
																	
																	<!-- Your additional content for adding badges -->
																	<div class="tab-pane" id="addSubject">
																		<div class="row">
																			<div class="col-md-12">
																				<h5 class="mb-3"></h5>
																				<div class="form-group">
																					<label for="input-1">Subject Name</label>
																					<input type="text" class="form-control" name="addedSubject" id="addedSubject" placeholder="" required>
																				</div>
																			
																				<br>
																				<center><button onclick="addNewBadge()" class="btn btn-success">Add Subject</button></center>
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
																	<center><h3>Delete Subject</h3></center>
																	<br>
																	<!-- Your additional content for adding badges -->
																	<div class="tab-pane" id="deleteSubject">
																		<div class="row">
																			<div class="col-md-12">
																				<div class="media align-items-center">
																				
																					<div class="progress-wrapper">
																					<?php
																						include("assets/php/connection.php");
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
													<div class="card" style ="min-height: 320px;">
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
																			include("assets/php/connection.php");

																			$query = "SELECT * FROM mentorship WHERE mentee_ID = '{$_SESSION['user_ID']}' and status = 'Approved'";
																			$result = mysqli_query($connection, $query);

																			$count = 1; // Initialize count variable

																			// Check if there are no mentees or no rows found
																			if (mysqli_num_rows($result) == 0) {
																				echo '<tr><td colspan="4">No mentors found.</td></tr>';
																			}
																			else {
																				while ($row = mysqli_fetch_assoc($result)) {
																					$mentor_ID = $row['mentor_ID'];
																					$query_2 = "SELECT * FROM user WHERE user_ID = '{$mentor_ID}'";
																					$result_2 = mysqli_query($connection, $query_2);
																					$row_2 = mysqli_fetch_assoc($result_2);

																					// Output each row of the table
																					echo '
																						<tr>
																							<th scope="row">' . $count . '</th>
																							<td>' . $row_2['name'] . '</td>
																							<td>' . $row['dateCreated'] . '</td>
																							<td>
																								<a href="myProfile.php?user_ID=' . $row_2['user_ID'] . '" class="btn btn-success">View</a>
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
																			<th scope="col">Application Date</th>
																			<th scope="col">Status</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																		include("assets/php/connection.php");

																		$query = "SELECT * FROM mentorship WHERE mentee_ID = '{$_SESSION['user_ID']}'";
																		$result = mysqli_query($connection, $query);

																		$count = 1; // Initialize count variable

																		while ($row = mysqli_fetch_assoc($result)) {
																			$mentor_ID = $row['mentor_ID'];
																			$query_2 = "SELECT * FROM user WHERE user_ID = '{$mentor_ID}'";
																			$result_2 = mysqli_query($connection, $query_2);
																			$row_2 = mysqli_fetch_assoc($result_2);
																			
																			// Output each row of the table
																			echo '
																				<tr>
																					<th scope="row">' . $count . '</th>
																					<td>' . $row_2['name'] . '</td>
																					<td>' . $row['dateCreated'] . '</td>
																					<td>';

																				if ($row['status'] === 'Approved') {
																					echo '<span class="badge badge-success"><i class="fa fa-cog"></i> ' . $row['status'] . '</span>';
																				} else if ($row['status'] === 'Pending')  {
																					echo '<span class="badge badge-warning"><i class="fa fa-cog"></i> ' . $row['status'] . '</span>';
																				}
																				else {
																					echo '<span class="badge badge-danger"><i class="fa fa-cog"></i> ' . $row['status'] . '</span>';
																				}

																				echo '
																					</td>
																				</tr>
																				';

																			$count++; // Increment count for each row
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
																<?php
																	include("assets/php/connection.php");

																	$query = "SELECT u.user_ID, u.name, COUNT(CASE WHEN m.status = 'Approved' THEN m.Mentee_ID END) AS numberOfMentees,
																			(SELECT AVG(r.stars) FROM review r
																				INNER JOIN feedback f ON r.review_ID = f.review_ID
																				WHERE f.reviewee = u.user_ID) AS rating
																		FROM user u
																		LEFT JOIN Mentorship m ON u.user_ID = m.Mentor_ID
																		WHERE u.mentorshipStatus = 'Mentor'
																		GROUP BY u.user_ID, u.name;
																		";
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
																					<th scope="col">Number of Mentees</th>
																					<th scope="col">Rating</th>
																					<th scope="col">Action</th>
																				</tr>
																			</thead>
																			<tbody>
																		';

																		// Output each row of the table
																		while ($row = mysqli_fetch_assoc($result)) {
																		?>
																			<tr>
																				<th scope="row"><?php echo $count; ?></th>
																				<td><?php echo $row['name']; ?></td>
																				<td><?php echo $row['numberOfMentees']; ?></td>
																				<td><?php echo round($row['rating'], 2); ?></td>
																				<td>
																					<a href="myProfile.php?user_ID=<?php echo $row['user_ID']; ?>" class="btn btn-success">View</a>
																					<?php 
																						$checkQuery = "SELECT * FROM mentorship WHERE mentor_ID = '{$row['user_ID']}' AND mentee_ID = '{$_SESSION['user_ID']}'";
																						$resulty = mysqli_query($connection, $checkQuery);

																						if ($resulty) {
																							// Check if a row exists in the result set
																							if (mysqli_num_rows($resulty)> 0) {
																							}
																							else if (mysqli_num_rows($resulty)== 0){
																								
																								echo '<a class="btn btn-success" onclick="apply(' . $row['user_ID'] . ')">Apply</a>';
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
				// Get the "Add" span element
				var addSpan = document.querySelector(".clickable-add");
				var addModal = document.getElementById("modal");
				var addModalCloseButton = addModal.querySelector(".close");
				var addModalContent = addModal.querySelector(".modal-content");
				
				// Function to display the add modal
				function showAddModal() {
					addModal.style.display = "block";
				}

				// Function to close the add modal
				function closeAddModal() {
					addModal.style.display = "none";
				}

				// Close the add modal if the background is clicked
				window.addEventListener("click", function(event) {
					if (event.target === addModal) {
						closeAddModal();
					}
				});


				// Prevent clicks inside the add modal content from closing the modal
				addModalContent.addEventListener("click", function(event) {
					event.stopPropagation();
				});	

				addSpan.addEventListener("click", function () {
					console.log("Add button clicked"); // Add this line
					showAddModal();
				});

				// Close the add modal when the close button is clicked
				addModalCloseButton.addEventListener("click", closeAddModal);

				// Get the "Delete" span element
				var deleteSpan = document.querySelector(".clickable-delete");

				// Get the delete modal, close button, and modal content
				var deleteModal = document.getElementById("delete-modal");
				var deleteModalCloseButton = deleteModal.querySelector(".close");
				var deleteModalContent = deleteModal.querySelector(".modal-content");
				
				// Function to display the delete modal
				function showDeleteModal() {
					deleteModal.style.display = "block";
				}

				// Function to close the delete modal
				function closeDeleteModal() {
					deleteModal.style.display = "none";
				}

				// Open the delete modal when the "Delete" span is clicked
				deleteSpan.addEventListener("click", showDeleteModal);

				// Close the delete modal when the close button is clicked
				deleteModalCloseButton.addEventListener("click", closeDeleteModal);

				// Close the delete modal if the background is clicked
				window.addEventListener("click", function(event) {
					if (event.target === deleteModal) {
						closeDeleteModal();
					}
				});

				// Prevent clicks inside the delete modal content from closing the modal
				deleteModalContent.addEventListener("click", function(event) {
					event.stopPropagation();
				});
						
				function addNewBadge() {
					var addedNameInput = document.getElementById("addedSubject");
					var addedName = addedNameInput.value;

					// Check if the input name is empty
					if (addedName.trim() === "") {
						alert("Please enter a name for the badge.");
						return; // Stop further execution
					}

					$.ajax({
						url: 'assets/php/cubaan.php',
						method: 'POST',
						data: { addedName: addedName },
						success: function (response) {
							// Handle the response from the PHP script
							console.log(response);

							// If the response indicates success, hide the "no-subjects-found" sentence
							if (response === "success") {
								var noSubjectsFound = document.getElementById("no-subjects-found");
								if (noSubjectsFound) {
									noSubjectsFound.style.display = "none";
								}

								// Create a new badge element
								var newBadge = document.createElement("a");
								newBadge.className = "badge badge-dark badge-pill mr-2";
								newBadge.style.marginTop = "10px"; // Add margin-top to the badge
								newBadge.innerText = addedName; // Set the badge text to the added name


								// Append the new badge to the "badge-container" div
								var badgeContainer = document.getElementById("badge-container");
								badgeContainer.appendChild(newBadge);

								// Count the number of badges currently in the container
								var badgeCount = badgeContainer.querySelectorAll(".badge").length;

								// If the badge count is a multiple of 4, open a new row
								if (badgeCount % 4 === 0) {
									// Create a new div to open a new row
									var newBadgeRow = document.createElement("div");
									newBadgeRow.className = "badge-wrapper d-flex flex-wrap";
									newBadgeRow.style.marginTop = "10px"; // Add an inline style for margin-top
									badgeContainer.appendChild(newBadgeRow);
								}


								alert("A new subject has been added!");
								closeAddModal();
							}
						},
						error: function (xhr, status, error) {
							// Handle the error
							console.log(error);
						}
					});
				}

				function apply(mentor_ID) {
					if (confirm("Are you sure you want to apply?")) {
						$.ajax({
						url: 'assets/php/process_applyToBeMentee.php',
						method: 'POST',
						data: { mentor_ID: mentor_ID },
						contentType: 'application/x-www-form-urlencoded; charset=UTF-8', // Set the Content-Type
						success: function(response) {
							// Handle the response from the PHP script
							console.log(response);
							if (response === "success") {
								alert("An application has been sent!");
							}

							// Reload the page
							location.reload();
						},
						error: function(xhr, status, error) {
							// Handle the error
							console.log(error);
						}
					});

					}
				}



				
				function deleteBadge(button) {

				const subject = button.getAttribute('data-subject');

				// Remove the entire parent container (the badge and the input field)
				button.parentNode.remove();

				// You can perform additional actions, such as deleting the subject from your data


				}

				function saveChanges() {
				const badgeInputs = document.querySelectorAll('.badge-input');
				const remainingValues = [];

				badgeInputs.forEach(function (input) {
					remainingValues.push(input.value);
				});

				// Create a string with "###" separator
				const remainingValuesString = remainingValues.join("###");

				// Send the remainingValuesString to your server for storage
				$.ajax({
					url: 'assets/php/process_saveSubjectChanges.php',
					method: 'POST',
					data: { remainingValues: remainingValuesString },
					success: function(response) {
						// Handle the response from the PHP script
						console.log(response);
					},
					error: function(xhr, status, error) {
						// Handle the error
						console.log(error);
					}
				});

				alert("Changes have been made!");
				// Reload the current page
				location.reload();
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