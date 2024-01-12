<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the session variable exists
if (!isset($_SESSION['user_ID'])) {
	// Redirect to the login page
	header("Location: index.php");
	exit();
} else {
	// Get the user_ID from the session
	$user_ID = $_SESSION['user_ID'];

?>



	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<title>My Application</title>

		<style>
			.page {
				display: none;
			}

			.visible {
				display: block;
			}
		</style>
		<!-- loader-->
		<link href="../assets/css/pace.min.css" rel="stylesheet" />
		<script src="assets/js/pace.min.js"></script>
		<!--favicon-->
		<link rel="icon" href="../assets/images/CB-favi.ico" type="image/x-icon">
		<!-- Vector CSS -->
		<!-- <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/> -->
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
		<script>
			function deleteGroupApplication(applicationID) {
				var confirmed = confirm("Are you sure you want to delete this StudyHub?");

				if (!confirmed) {
					return;
				}

				// Make an AJAX request to your server-side PHP script to delete the studyhub
				$.ajax({
					url: '../assets/php/open-application/process_deleteGroupApplication.php',
					method: 'GET',
					data: {
						application_ID: applicationID
					},
					success: function(response) {
						// Handle the response from the PHP script
						console.log(response);
						if (response === "Application deleted successfully!") {
							// Application deletion was successful
							alert(response);
							// Perform any necessary UI updates or redirects
							window.location.reload(); // Refresh the page to update the application list
						} else {
							// Application deletion failed
							alert(response);
							// Perform any necessary error handling
						}
					},
					error: function(xhr, status, error) {
						// Handle the error
						console.log(error);
					}
				});
			}
		</script>
	</head>

	<body class="bg-theme bg-theme9">

		<div id="wrapper">
			<?php include_once('nav/sidebar.php'); ?>
			<?php include_once('nav/topbar.php'); ?>

			<div class="clearfix"></div>

			<div class="content-wrapper">
				<div class="container-fluid">
					<p>
					<p>
					<div class="row" style="justify-content: center; align-items: center; margin-bottom: 20px;">
						<button class="btn btn-primary" id="list_1Button" onclick="togglePage('list_1')">Created Application</button>
						<button class="btn btn-dark" id="list_2Button" onclick="togglePage('list_2')">Applied Application</button>
					</div>
					<!-- Start of Created Application -->
					<div class="row" id="list_1">
						<div class="col-12 col-lg-12">
							<div class="card">
								<div class="card-body">
									<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
										<li class="nav-item">
											<a href="javascript:void();" data-target="#create-group" data-toggle="pill" class="nav-link active"><i class="icon-user"></i> <span class="hidden-xs">Group Application</span></a>
										</li>
										<li class="nav-item">
											<a href="javascript:void();" data-target="#create-club" data-toggle="pill" class="nav-link"><i class="icon-note"></i> <span class="hidden-xs">Club Application</span></a>
										</li>
									</ul>
									<!-- FIRST CONTENT (CREATED APPLICATION)  -->
									<div class="tab-content p-3">
										<!-- START OF MY CREATED GROUP APPLICATIONS  -->
										<div class="tab-pane active" id="create-group">
											<div class="row">
												<div class="col-lg-12">
													<div class="card">
														<div class="card-body">
															<div class="d-flex justify-content-between">
																<div class="card-title">Created Group Applications</div>
																<div>
																	<span class="badge badge-success clickable-add mr-2" style="cursor: pointer;"><i></i> + Create</span>
																</div>
															</div>

															<div class="table-responsive">
																<table id="groupApplicationsTable" class="table table-hover">
																	<thead>
																		<tr>
																			<th scope="col">#</th>
																			<th scope="col">Course Name</th>
																			<th scope="col" style="text-align: center;">Project Name</th>
																			<th scope="col" colspan="2" style="text-align: center;">Action</th>
																		</tr>
																	</thead>
																	<tbody id="groupApplicationsTableBody">
																		<?php
																		include("../assets/php/connection.php");

																		$query = "SELECT course_name, application_id, project_name FROM `group-application` where user_ID = '{$_SESSION['user_ID']}';";

																		$result = mysqli_query($connection, $query);

																		$count = 1; // Initialize count variable

																		// Check if there are no pending applications
																		if (mysqli_num_rows($result) == 0) {
																			echo '<tr><td colspan="5">No applications found.</td></tr>';
																		} else {
																			while ($row = mysqli_fetch_assoc($result)) {

																				// Output each row of the table
																				echo '
                                                                                    <tr>
                                                                                    <th scope="row">' . $count . '</th>
                                                                                    <td>' . $row['course_name'] . '</td>
                                                                                    <td style="text-align: center;">' . $row['project_name'] . '</td>                                                                               
                                                                                    <td style="text-align: center;">
                                                                                        <a href="group_application_view.php?application_ID=' . $row['application_id'] . '" class="btn btn-info">View</a>
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
										<!-- END OF MY CREATED GROUP APPLICATIONS  -->

										<!-- ADD GROUP -->
										<div id="modal" class="modal">
											<div class="modal-content" style="max-height: 90vh;">
												<span class="close">&times;</span>
												<!-- Content for your modal goes here -->
												<center>
													<h3>Create Application</h3>
												</center>

												<!-- Your additional content for adding badges -->
												<div class="tab-pane" id="addGroup">
													<div class="row">
														<div class="col-md-12">
															<h5 class="mb-3"></h5>

															<label for="input-1">Department:</label>
															<select class="form-control" name="department_name" id="input-1">
																<option value="Department of Artificial Intelligende">Department of Artificial Intelligence</option>
																<option value="Department of Computer System and Network">Department of Computer System and Network</option>
																<option value="Department of Information System">Department of Information System</option>
																<option value="Department of Software Engineering">Department of Software Engineering</option>
																<option value="Department of Multimedia Computing">Department of Multimedia Computing</option>
																<option value="Department of Data Science">Department of Data Science </option>
															</select>
															<br>

															<!-- Course Name -->
															<div class="form-group">
																<label for="input-3">Course:</label>
																<input type="text" class="form-control" id="input-2" name="course_name" placeholder="Enter the course name">
															</div>

															<!-- Project Name -->
															<div class="form-group">
																<label for="input-3">Project Name:</label>
																<input type="text" class="form-control" id="input-3" name="project_name" placeholder="Enter your project name">
															</div>

															<!-- Project Description -->
															<div class="form-group">
																<label for="input-4">Project Description:</label>
																<input type="text" class="form-control" id="input-4" name="project_description" placeholder="Enter project description">
															</div>

															<!-- Skill Wanted -->
															<div class="form-group">
																<label for="input-5">Skills Wanted:</label>
																<input type="text" class="form-control" id="input-5" name="skill_needed" placeholder="Enter the skill sets you wanted">
															</div>

															<!-- Notes -->
															<div class="form-group">
																<label for="input-6">Notes:</label>
																<input type="text" class="form-control" id="input-6" name="notes" placeholder="Enter extra notes if there is any">
															</div>
															<center><button onclick="addNewGroup()" class="btn btn-success">Create</button></center>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- END OF ADD GROUP -->

										<!-- START OF MY CREATED CLUB APPLICATIONS  -->
										<div class="tab-pane" id="create-club">
											<div class="row">
												<div class="col-lg-12">
													<div class="card">
														<div class="card-body">
															<div class="d-flex justify-content-between">
																<div class="card-title">Created Club Applications</div>
																<div>
																	<span class="badge badge-success clickable-addClub mr-2" style="cursor: pointer;" id="createClubButton"><i></i> + Create</span>
																</div>
															</div>
															<div class="table-responsive">
																<table id="clubApplicationsTable" class="table table-hover">
																	<thead>
																		<tr>
																			<th scope="col">#</th>
																			<th scope="col">Club Name</th>
																			<th scope="col" style="text-align: center;">Position</th>
																			<th scope="col" colspan="2" style="text-align: center;">Action</th>
																		</tr>
																	</thead>
																	<tbody id="clubApplicationsTableBody">
																		<?php
																		include("../assets/php/connection.php");

																		// Check if the user is logged in, and if so, get their user_ID
																		if (isset($_SESSION["user_ID"])) {
																			$user_ID = $_SESSION["user_ID"];

																			$query = "SELECT * FROM `club` WHERE user_ID = ?";
																			// var_dump($user_ID);
																			$stmt = $connection->prepare($query);
																			$stmt->bind_param("i", $user_ID);
																			$stmt->execute();
																			$result = $stmt->get_result();
																			// $query = "SELECT * FROM `club-application` where user_ID = '{$_SESSION['user_ID']}';";

																			// $result = mysqli_query($connection, $query);

																			$count = 1; // Initialize count variable

																			// Check if there are no pending applications
																			if ($result->num_rows == 0) {
																				echo '<tr><td colspan="5">No applications found.</td></tr>';
																			} else {
																				while ($row = $result->fetch_assoc()) {
																					// Output each row of the table
																					echo '
																						<tr>
																						<th scope="row">' . $count . '</th>
																						<td>' . $row['club_name'] . '</td>
																						<td style="text-align: center;">' . $row['position_available'] . '</td>                   
																						<td style="text-align: center;">
																							<a href="club_application_view.php?club_ID=' . $row['club_ID'] . '" class="btn btn-info">View</a>
																						</td>
																						</tr>';

																					$count++; // Increment count for each row
																				}
																			}

																			$stmt->close();
																		} else {
																			echo "User not logged in.";
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
										<!-- END OF MY CREATED CLUB APPLICATIONS  -->

										<!-- ADD CLUB -->
										<div id="modal_2" class="modal">
											<div class="modal-content" style="max-height: 90vh;">
												<span class="close">&times;</span>
												<!-- Content for your modal goes here -->
												<center>
													<h3>Create Application</h3>
												</center>

												<!-- Your additional content for adding badges -->
												<div class="tab-pane" id="addGroup">
													<div class="row">
														<div class="col-md-12">
															<h5 class="mb-3"></h5>
															<br>

															<!-- Club Name -->
															<div class="form-group">
																<label for="input-7">Club Name:</label>
																<input type="text" class="form-control" id="input-7" placeholder="Enter the club name">
															</div>

															<!-- Club Description -->
															<div class="form-group">
																<label for="input-8">Club Description:</label>
																<input type="text" class="form-control" id="input-8" placeholder="Enter club description">
															</div>

															<!-- Position Available -->
															<div class="form-group">
																<label for="input-9">Position Available:</label>
																<input type="text" class="form-control" id="input-9" placeholder="Enter the position available">
															</div>

															<!-- Club Skill Wanted -->
															<div class="form-group">
																<label for="input-10">Skills Wanted:</label>
																<input type="text" class="form-control" id="input-10" placeholder="Enter the skill sets you wanted">
															</div>

															<!-- Club Notes -->
															<div class="form-group">
																<label for="input-11">Notes:</label>
																<input type="text" class="form-control" id="input-11" name="notes" placeholder="Enter extra notes if there is any">
															</div>
															<center><button onclick="addNewClub()" class="btn btn-success">Create</button></center>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- END OF ADD CLUB -->

									</div>

								</div>
							</div>
						</div>
					</div>
					<!-- End of Created Application -->

					<!-- Start of Applied Application -->
					<div class="row" id="list_2" style="display:none;">
						<div class="col-12 col-lg-12">
							<div class="card">

								<div class="card-body">
									<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
										<li class="nav-item">
											<a href="javascript:void();" data-target="#applied-group" data-toggle="pill" class="nav-link active"><i class="icon-user"></i> <span class="hidden-xs">Group Application</span></a>
										</li>
										<li class="nav-item">
											<a href="javascript:void();" data-target="#applied-club" data-toggle="pill" class="nav-link"><i class="icon-note"></i> <span class="hidden-xs">Club Application</span></a>
										</li>
									</ul>

									<!-- SECOND CONTENT (APPLIED APPLICATION)  -->
									<div class="tab-content p-3">
										<!-- START OF MY APPLIED GROUP APPLICATIONS  -->
										<div class="tab-pane active" id="applied-group">
											<div class="row">
												<div class="col-lg-12">
													<div class="card">
														<div class="card-body">
															<div class="card-title">Applied Group Applications</div>
															<div class="table-responsive">
																<table class="table table-hover">
																	<thead>
																		<tr>
																			<th scope="col">#</th>
																			<th scope="col">Course Name</th>
																			<th scope="col" style="text-align: center;">Project Name</th>
																			<th scope="col" style="text-align: center;">Status</th>
																			<th scope="col" colspan="2" style="text-align: center;">Action</th>
																		</tr>
																	</thead>
																	<tbody>
																	<?php
																		include("../assets/php/connection.php");

																		$query = "SELECT ga.course_name, ga.application_id, ga.project_name, gas.status
                                                                                FROM `group-application` AS ga
                                                                                JOIN `group_applicant_status` AS gas
                                                                                ON ga.application_ID = gas.application_ID
                                                                                WHERE gas.applicant_ID = '{$_SESSION['user_ID']}';";

																		$result = mysqli_query($connection, $query);

																		$count = 1; // Initialize count variable

																		// Check if there are no pending applications
																		if (mysqli_num_rows($result) == 0) {
																			echo '<tr><td colspan="5">No applications found.</td></tr>';
																		} else {
																			while ($row = mysqli_fetch_assoc($result)) {

																				// Output each row of the table
																				echo '
                                                                                    <tr>
                                                                                    <th scope="row">' . $count . '</th>
                                                                                    <td style="text-align: center;">' . $row['course_name'] . '</td>
                                                                                    <td style="text-align: center;">' . $row['project_name'] . '</td>
                                                                                    <td style="text-align: center;">';

																				if ($row['status'] === 'Approved') {
																					echo '<span class="badge badge-success"><i class="fa fa-cog"></i> ' . $row['status'] . '</span>';
																				} else if ($row['status'] === 'Pending') {
																					echo '<span class="badge badge-warning"><i class="fa fa-cog"></i> ' . $row['status'] . '</span>';
																				} else {
																					echo '<span class="badge badge-danger"><i class="fa fa-cog"></i> ' . $row['status'] . '</span>';
																				}

																				echo '
																					</td>
                                                                                    <td style="text-align: center;">
                                                                                        <a href="group_application_view.php?application_ID=' . $row['application_id'] . '" class="btn btn-info">View</a>
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
										<!-- END OF MY APPLIED GROUP APPLICATIONS  -->

										<div class="tab-pane" id="applied-club">
											<div class="row">
												<div class="col-lg-12">
													<div class="card">
														<div class="card-body">
															<div class="card-title">Applied Club Applications</div>
															<div class="table-responsive">
																<table class="table table-hover">
																	<thead>
																		<tr>
																			<th scope="col">#</th>
																			<th scope="col">Club Name</th>
																			<th scope="col" style="text-align: center;">Position</th>
																			<th scope="col" style="text-align: center;">Status</th>
																			<th scope="col" colspan="2" style="text-align: center;">Action</th>
																		</tr>
																	</thead>
																	<tbody>
																	<?php
																		include("../assets/php/connection.php");

																		$query = "SELECT ca.club_name, ca.club_id, ca.position_available, cas.status FROM club AS ca JOIN `clubApplication` AS cas ON ca.club_id = cas.club_ID WHERE cas.applicant_ID = '{$_SESSION['user_ID']}';";

																		$result = mysqli_query($connection, $query);

																		$count = 1; // Initialize count variable

																		// Check if there are no pending applications
																		if (mysqli_num_rows($result) == 0) {
																			echo '<tr><td colspan="5">No applications found.</td></tr>';
																		} else {
																			while ($row = mysqli_fetch_assoc($result)) {

																				// Output each row of the table
																				echo '
                                                                                    <tr>
                                                                                    <th scope="row">' . $count . '</th>
                                                                                    <td>' . $row['club_name'] . '</td>
                                                                                    <td style="text-align: center;">' . $row['position_available'] . '</td>
                                                                                    <td style="text-align: center;">';

																				if ($row['status'] === 'Approved') {
																					echo '<span class="badge badge-success"><i class="fa fa-cog"></i> ' . $row['status'] . '</span>';
																				} else if ($row['status'] === 'Pending') {
																					echo '<span class="badge badge-warning"><i class="fa fa-cog"></i> ' . $row['status'] . '</span>';
																				} else {
																					echo '<span class="badge badge-danger"><i class="fa fa-cog"></i> ' . $row['status'] . '</span>';
																				}

																				echo '
																					</td>
                                                                                    <td style="text-align: center;">
                                                                                        <a href="clubApplication.php?club_ID=' . $row['club_id'] . '" class="btn btn-info">View</a>
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
										<!-- END OF MY APPLIED GROUP APPLICATIONS  -->

									</div>
									<!-- END OF SECOND CONTENT (APPLIED APPLICATION)  -->

								</div>

							</div>
						</div>
					</div>
					<!-- End of Applied Application -->

					<div class="overlay toggle-menu"></div>
				</div>
			</div>


			<script>
				var addSpan = document.querySelector(".clickable-addClub");

				// Get the add modal, close button, and modal content
				var addModal = document.getElementById("modal_2");
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

				// Open the add modal when the "Add" span is clicked
				addSpan.addEventListener("click", showAddModal);

				// Close the add modal when the close button is clicked
				addModalCloseButton.addEventListener("click", closeAddModal);

				var addGroupSpan = document.querySelector(".clickable-add");

				var addGroupModal = document.getElementById("modal");
				var addGroupModalCloseButton = addGroupModal.querySelector(".close");
				var addGroupModalContent = addGroupModal.querySelector(".modal-content");

				// Function to display the add modal
				function showAddGroupModal() {
					addGroupModal.style.display = "block";
				}

				// Function to close the add modal
				function closeAddGroupModal() {
					addGroupModal.style.display = "none";
				}

				// Open the add modal when the "Add" span is clicked
				addGroupSpan.addEventListener("click", showAddGroupModal);
				// Close the add modal when the close button is clicked
				addGroupModalCloseButton.addEventListener("click", closeAddGroupModal);

				function togglePage(pageId) {
					// Hide all pages
					document.getElementById('list_1').style.display = 'none';
					document.getElementById('list_2').style.display = 'none';

					// Show the selected page
					document.getElementById(pageId).style.display = 'block';

					// Update button styles based on active page
					document.getElementById('list_1Button').className = 'btn ' + (pageId === 'list_1' ? 'btn-primary' : 'btn-dark');
					document.getElementById('list_2Button').className = 'btn ' + (pageId === 'list_2' ? 'btn-primary' : 'btn-dark');
				}


				function addNewGroup() {
					var addedDepartmentInput = document.getElementById("input-1");
					var addedDepartment = addedDepartmentInput.value;

					var addedCourseInput = document.getElementById("input-2");
					var addedCourse = addedCourseInput.value;

					var addedNameInput = document.getElementById("input-3");
					var addedName = addedNameInput.value;

					var addedDescriptionInput = document.getElementById("input-4");
					var addedDescription = addedDescriptionInput.value;

					var addedSkillsInput = document.getElementById("input-5");
					var addedSkills = addedSkillsInput.value;

					var addedNotesInput = document.getElementById("input-6");
					var addedNotes = addedNotesInput.value;

					var focusOnFirstEmptyField = function() {
						if (addedDepartment === "") {
							addedDepartmentInput.focus();
						} else if (addedCourse === "") {
							addedCourseInput.focus();
						} else if (addedName === "") {
							addedNameInput.focus();
						} else if (addedDescription === "") {
							addedDescriptionInput.focus();
						} else if (addedSkills === "") {
							addedSkillsInput.focus();
						} else if (addedNotes === "") {
							addedNotesInput.focus();
						}
					};

					// Check if any of the fields are empty
					if (
						addedDepartment === "" ||
						addedCourse === "" ||
						addedName === "" ||
						addedDescription === "" ||
						addedSkills === "" ||
						addedNotes === ""
					) {
						alert("Please fill in all fields");
						focusOnFirstEmptyField();
						return;
					}


					$.ajax({
						url: '../assets/php/open-application/process_addGroup.php',
						method: 'POST',
						data: {
							addedDepartment: addedDepartment,
							addedCourse: addedCourse,
							addedName: addedName,
							addedDescription: addedDescription,
							addedSkills: addedSkills,
							addedNotes: addedNotes
						},
						success: function(response) {
							// Split the response using the pipe character
							var responseParts = response.split('|');
							var status = responseParts[0]; // Get the status (success or error)
							var newApplicationID = responseParts[1]; // Get the newApplicationID
							if (status === "success") {
								alert("A new group application has been created!");
								closeAddGroupModal

								// Calculate rowCount dynamically based on the last row number
								var rowCount = $('#groupApplicationsTableBody tr').length + 1;

								// Append a new row to the table
								var newRow = '<tr>' +
									'<th scope="row">' + rowCount + '</th>' +
									'<td>' + addedCourse + '</td>' +
									'<td style="text-align:center;">' + addedName + '</td>' +
									'<td style="text-align:center;"><a href="group_application_view.php?application_ID=' + newApplicationID + '" class="btn btn-info">View</a></td>' +
									'</tr>';

								// Hide "No applications found" message if it exists
								var noApplicationsMessage = $('#groupApplicationsTableBody td:contains("No applications found.")');
								if (noApplicationsMessage.length > 0) {
									noApplicationsMessage.parent().remove();
								}

								$('#groupApplicationsTableBody').append(newRow); // Append the new row
							} else {
								alert("Error occurred");
							}
						},
						error: function(xhr, status, error) {
							// Handle the error
							console.log(error);
						}
					});
				}

				function addNewClub() {
					var addedClubNameInput = document.getElementById("input-7");
					var addedClubName = addedClubNameInput.value;

					var addedClubDescriptionInput = document.getElementById("input-8");
					var addedClubDescription = addedClubDescriptionInput.value;

					var addedClubPositionInput = document.getElementById("input-9");
					var addedClubPosition = addedClubPositionInput.value;

					var addedClubSkillsInput = document.getElementById("input-10");
					var addedClubSkills = addedClubSkillsInput.value;

					var addedClubNotesInput = document.getElementById("input-11");
					var addedClubNotes = addedClubNotesInput.value;

					$.ajax({
						url: '../assets/php/open-application/process_addClub.php',
						method: 'POST',
						data: {
							addedClubName: addedClubName,
							addedClubDescription: addedClubDescription,
							addedClubPosition: addedClubPosition,
							addedClubSkills: addedClubSkills,
							addedClubNotes: addedClubNotes
						},
						success: function(response) {
							// Split the response using the pipe character
							var responseParts = response.split('|');
							var status = responseParts[0]; // Get the status (success or error)
							var newApplicationID = responseParts[1]; // Get the newApplicationID

							if (status === "success") {
								alert("A new club has been created!");
								closeAddModal();

								// Calculate rowCount dynamically based on the last row number
								var rowCount = $('#clubApplicationsTableBody tr').length + 1;

								// Append a new row to the table
								var newRow = '<tr>' +
									'<th scope="row">' + rowCount + '</th>' +
									'<td>' + addedClubName + '</td>' +
									'<td style="text-align:center;">' + addedClubPosition + '</td>' +
									'<td style="text-align:center;"><a href="club_application_view.php?application_ID=' + newApplicationID + '" class="btn btn-info">View</a></td>' +
									'</tr>';

								// Hide "No applications found" message if it exists
								var noApplicationsMessage = $('#clubApplicationsTableBody td:contains("No applications found.")');
								if (noApplicationsMessage.length > 0) {
									noApplicationsMessage.parent().remove();
								}

								$('#clubApplicationsTableBody').append(newRow); // Append the new row
							} else {
								alert("Error occurred");
							}
						},
						error: function(xhr, status, error) {
							// Handle the error
							console.log(error);
						}
					});
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


		</div>

		<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
		<script src="assets/js/testing.js"></script>
		<!-- Bootstrap core JavaScript-->
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/popper.min.js"></script>
		<script src="../assets/js/bootstrap.min.js"></script>

		<!-- simplebar js -->
		<script src="../assets/plugins/simplebar/js/simplebar.js"></script>
		<!-- sidebar-menu js -->
		<script src="../assets/js/sidebar-menu.js"></script>
		<!-- loader scripts -->
		<!-- <script src="assets/js/jquery.loading-indicator.js"> -->
		<!-- Custom scripts -->
		<script src="../assets/js/app-script.js"></script>
		<!-- Chart js -->

		<script src="../assets/plugins/Chart.js/Chart.min.js"></script>
		<script src="../assets/js/notifications.js"></script>

		<script>
			displayNotifications();
		</script>


	</body>

	</html>
<?php

}
?>