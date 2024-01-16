<?php
session_start();

// Check if the session variable exists
if (!isset($_SESSION['user_ID'])) {
	// Redirect to the login page
	header("Location: index.php");
	exit();
} else {

	include("../assets/php/connection.php");

	if (isset($_GET['club_ID'])) {
		$club_ID = $_GET['club_ID'];

		// Fetch the study hub profile based on the studyhub_ID
		$sql = "SELECT * FROM club WHERE club_ID = '$club_ID'";

		// Execute the query
		$result = mysqli_query($connection, $sql);

		// Check if the query returned any rows
		if (mysqli_num_rows($result) > 0) {
			// Study hub profile found
			$club = mysqli_fetch_assoc($result);
			$club_name = $club['club_name'];
			$club_description = $club['club_description'];
			$position_available = $club['position_available'];
			$skill_needed = $club['skill_needed'];
			$notes = $club['notes'];
			$application_date = $club['application_date'];
			$user_ID = $club['user_ID'];
		} else {
			// Study hub profile not found, handle the error
			echo "Club Application not found.";
		}
	} else {
		// Studyhub ID not provided, handle the error
		echo "Club Application ID is not provided.";
	}
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
	<title>Club/Association</title>
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
	<style>
		.hover-effect:hover {
			filter: brightness(1.7);
			/* Adjust the brightness as needed */
		}
	</style>

</head>

<body class="bg-theme bg-theme9">
	<div id="pageloader-overlay" class="visible incoming">
		<div class="loader-wrapper-outer">
			<div class="loader-wrapper-inner">
				<div class="loader"></div>
			</div>
		</div>
	</div>
	<div id="wrapper">
		<?php include_once('nav/sidebar.php'); ?>
		<?php include_once('nav/topbar.php'); ?>


		<div class="clearfix"></div>

		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row mt-3">
					<div class="col-lg-6">
						<div class="card">
							<div class="card-body">
								<div class="card-title">Club/Association Form</div>
								<hr>
								<!--Group Application - Form-->
								<div>
									<!--Club Name-->
									<div class="form-group">
										<label for="input-1">Club Name:</label>
										<input type="text" class="form-control" id="input-1" name="club_name" value="<?php echo $club_name; ?>" <?php if ($_SESSION['user_ID'] != $user_ID)
																																					echo 'readonly'; ?>>
									</div>

									<!--Club Description-->
									<div class="form-group">
										<label for="input-2">Club Description:</label>
										<input type="text" class="form-control" id="input-2" name="club_description" value="<?php echo $club_description; ?>" <?php if ($_SESSION['user_ID'] != $user_ID)
																																									echo 'readonly'; ?>>
									</div>

									<!--Position Available-->
									<div class="form-group">
										<label for="input-3">Position Available:</label>
										<input type="text" class="form-control" id="input-3" name="position_available" value="<?php echo $position_available; ?>" <?php if ($_SESSION['user_ID'] != $user_ID)
																																										echo 'readonly'; ?>>
									</div>

									<!--Skill Wanted-->
									<div class="form-group">
										<label for="input-4">Skill Wanted:</label>
										<input type="text" class="form-control" id="input-4" name="skill_needed" value="<?php echo $skill_needed; ?>" <?php if ($_SESSION['user_ID'] != $user_ID)
																																							echo 'readonly'; ?>>
									</div>

									<div class="form-group">
										<label for="input-6">Notes:</label>
										<input type="text" class="form-control" id="input-5" name="notes" value="<?php echo $notes; ?>" <?php if ($_SESSION['user_ID'] != $user_ID)
																																			echo 'readonly'; ?>>
									</div>

									<!-- Edit button - only available for application creator-->
									<?php
									if ($_SESSION['user_ID'] == $user_ID) {
										echo '<center><button onclick="editClubInfo(' . $club_ID . ')" class="btn btn-primary px-5">Save Changes</button></center>';
									}
									?>


									<!-- Apply button - only avaiable for applicant -->
									<?php
									include("../assets/php/connection.php");


									if ($_SESSION['user_ID'] != $user_ID) {

										$sql = "SELECT * FROM clubApplication WHERE club_ID = '$club_ID'";

										$result = mysqli_query($connection, $sql);

										if (mysqli_num_rows($result) == 0) {
											echo '<div style="display: flex; justify-content: center">';
											echo '<button onclick = applyPosition(' . $club_ID . ') class="btn btn-success">Apply</button>';
											echo '<a href="javascript:history.back()" class="btn btn-light" style="margin-left: 10px">Back</a>';
											echo '</div>';
										} else {
											echo '<div style="display: flex; justify-content: center">';
											echo '<a href="javascript:history.back()" class="btn btn-light">Back</a>';
											echo '</div>';
										}
									}
									?>


								</div>

							</div>
						</div>
					</div>


					<div class="col-lg-6">
						<div class="card">
							<?php
							include("../assets/php/connection.php");

							// Check if the user_ID from group-applicantion is equal to the current session user_ID
							if ($_SESSION['user_ID'] === $user_ID) {
							?>

								<div class="card-body">
									<h5 class="card-title">Pending Applicant List</h5>
									<div class="table-responsive">

										<table class="table table-hover">

											<thead>
												<tr>
													<th scope="col"></th>
													<th scope="col">Name</th>
													<th scope="col">Status</th>
													<th scope="col">Action</th>
												</tr>
											</thead>

											<tbody id="yourTableBody1">


											</tbody>

										</table>
									</div>
								</div>



						</div>

						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Rejected Applicant List</h5>
								<div class="table-responsive">

									<table class="table table-hover">

										<thead>
											<tr>
												<th scope="col"></th>
												<th scope="col">Name</th>
												<th scope="col">Status</th>
											</tr>
										</thead>
										<tbody id="yourTableBody2">
											<!-- Table rows will be dynamically added here -->
										</tbody>


									</table>
								</div>
							</div>
						</div>

						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Approved Applicant List</h5>
								<div class="table-responsive">

									<table class="table table-hover">

										<thead>
											<tr>
												<th scope="col"></th>
												<th scope="col">Name</th>
												<th scope="col">Status</th>
											</tr>
										</thead>
										<tbody id="yourTableBody3">
											<!-- Table rows will be dynamically added here -->
										</tbody>


									</table>
								</div>
							</div>
						</div>
					<?php
							} // Close the if statement
					?>
					</div>


					<div class="overlay toggle-menu"></div>
				</div>
			</div>
		</div>
		<script src="../assets/js/notification.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

		<script>
			displayNotifications();
			// Initial table load
			$(document).ready(function() {
				fetchPendingApplicants();
				fetchRejectedApplicants();
				fetchApprovedApplicants();
			});

			function fetchPendingApplicants() {
				// Fetch data for the second table
				var club_ID = <?php echo $club_ID ?>;
				var status = "Pending";
				$.ajax({
					url: '../assets/php/open-application/process_fetchClubApplicants.php',
					method: 'POST',
					dataType: 'json',
					data: {
						club_ID: club_ID,
						status: status
					},
					success: function(data) {
						console.log(data); // Display the fetched data in the console

						var tableBody1 = $('#yourTableBody1'); // Update with your actual second table body ID
						tableBody1.empty(); // Clear existing rows
						if (data.length > 0) {
							for (var i = 0; i < data.length; i++) {
								var row = data[i];
								var daysSinceCreation = (row['days_since_creation'] == 0) ? 'Today' : row['days_since_creation'] + ' days ago';
								var html = '<tr>' +
									'<td>' + daysSinceCreation + '</td>' +
									'<td><a href="viewProfile.php?user_ID=' + row['user_ID'] + '">' + row['name'] + '</a></td>' +

									'<td><span class="badge badge-warning"><i class="fa fa-cog"></i> ' + row['status'] + '</span></td>' +
									'<td>' +
									'<img width="30" height="30" src="https://img.icons8.com/fluency/48/checkmark--v1.png" alt="checkmark--v1" onclick="respondApplication(' + row['clubApplication_ID'] + ', \'Approved\')" style="cursor: pointer;" title="Approve" class="hover-effect">&nbsp;&nbsp;' +
									'<img width="30" height="30" src="https://img.icons8.com/fluency/48/delete-sign.png" alt="delete-sign" onclick="respondApplication(' + row['clubApplication_ID'] + ', \'Rejected\')" style="cursor: pointer;" title="Reject" class="hover-effect">&nbsp;&nbsp;' +
									'</td>' +
									'</tr>';

								tableBody1.append(html);
							}
						} else {
							var html = '<tr><td colspan="4">There is no pending application yet</td></tr>';
							tableBody1.append(html);
						}
					},
					error: function(xhr, status, error) {
						console.error(xhr.responseText); // Log any error response to the console
					}
				});
			}

			function fetchRejectedApplicants() {
				var club_ID = <?php echo $club_ID ?>;
				var status = "Rejected";
				$.ajax({
					url: '../assets/php/open-application/process_fetchClubApplicants.php',
					method: 'POST',
					dataType: 'json',
					data: {
						club_ID: club_ID,
						status: status
					},
					success: function(data) {
						console.log(data); // Display the fetched data in the console

						var tableBody2 = $('#yourTableBody2'); // Update with your actual second table body ID
						tableBody2.empty(); // Clear existing rows
						if (data.length > 0) {
							for (var i = 0; i < data.length; i++) {
								var row = data[i];
								var daysSinceCreation = (row['days_since_creation'] == 0) ? 'Today' : row['days_since_creation'] + ' days ago';
								var html = '<tr>' +
									'<td>' + daysSinceCreation + '</td>' +
									'<td><a href="viewProfile.php?user_ID=' + row['user_ID'] + '">' + row['name'] + '</a></td>' +
									'<td><span class="badge badge-danger"><i class="fa fa-cog"></i> ' + row['status'] + '</span></td>' +
									'</tr>';

								tableBody2.append(html);
							}
						} else {
							var html = '<tr><td colspan="4">There is no rejected application yet</td></tr>';
							tableBody2.append(html);
						}
					},
					error: function(xhr, status, error) {
						console.error(xhr.responseText); // Log any error response to the console
					}
				});
			}

			function fetchApprovedApplicants() {
				var club_ID = <?php echo $club_ID ?>;
				var status = "Approved";
				$.ajax({
					url: '../assets/php/open-application/process_fetchClubApplicants.php',
					method: 'POST',
					dataType: 'json',
					data: {
						club_ID: club_ID,
						status: status
					},
					success: function(data) {
						console.log(data); // Display the fetched data in the console

						var tableBody3 = $('#yourTableBody3'); // Update with your actual second table body ID
						tableBody3.empty(); // Clear existing rows
						if (data.length > 0) {
							for (var i = 0; i < data.length; i++) {
								var row = data[i];
								var daysSinceCreation = (row['days_since_creation'] == 0) ? 'Today' : row['days_since_creation'] + ' days ago';
								var html = '<tr>' +
									'<td>' + daysSinceCreation + '</td>' +
									'<td><a href="viewProfile.php?user_ID=' + row['user_ID'] + '">' + row['name'] + '</a></td>' +
									'<td><span class="badge badge-success"><i class="fa fa-cog"></i> ' + row['status'] + '</span></td>' +
									'</tr>';

								tableBody3.append(html);
							}
						} else {
							var html = '<tr><td colspan="4">There is no approved application yet</td></tr>';
							tableBody3.append(html);
						}
					},
					error: function(xhr, status, error) {
						console.error(xhr.responseText); // Log any error response to the console
					}
				});
			}
		</script>
		<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>

		<footer class="footer">
			<div class="container">
				<div class="text-center">
				</div>
			</div>
		</footer>

	</div>

	<script>
		function applyPosition(club_ID) {
			if (confirm("Are you sure you want to apply this application?")) {
				$.ajax({
					url: "../assets/php/open-application/process_applyClub.php",
					method: "POST",
					data: {
						club_ID: club_ID
					},
					success: function(response) {
						// Handle the response from the PHP script
						console.log(response);
						alert("You have successfully applied!");
					},
					error: function(xhr, status, error) {
						// Handle the error
						console.log(error);
					},
				});
			}
		}

		function editClubInfo(ID) {
			var club_ID = ID;
			var clubName = document.getElementById("input-1").value;
			var description = document.getElementById("input-2").value;
			var position = document.getElementById("input-3").value;
			var skill = document.getElementById("input-4").value;
			var notes = document.getElementById("input-5").value;

			$.ajax({
				url: '../assets/php/open-application/process_editClub.php',
				method: 'POST',
				data: {
					clubID: club_ID,
					clubName: clubName,
					description: description,
					position: position,
					skill: skill,
					notes: notes
				},
				success: function(response) {
					// Handle the response from the PHP script
					console.log(response);
					if (response.trim().toLowerCase() === "success") {
						alert("Application has been updated!");

					}

				},
				error: function(xhr, status, error) {
					// Handle the error
					console.log(error);
				}
			});
		}

		function respondApplication(clubApplication_ID, answer) {
			var answerText = answer.toLowerCase();
			if (answerText === "rejected") {
				answerText = answerText.slice(0, -2);
			} else {
				answerText = answerText.slice(0, -1);
			}
			if (confirm("Are you sure you want to " + answerText + " this application?")) {
				$.ajax({
					url: "../assets/php/open-application/process_approveClubApplication.php",
					method: "POST",
					data: {
						clubApplication_ID: clubApplication_ID,
						status: answer
					},
					success: function(response) {
						/// Handle the response from the PHP script
						console.log(response);
						if (answer == "Rejected") {
							alert("Application has been rejected!");
						} else {
							alert("Application has been approved!");
						}

						var tableBody1 = $('#yourTableBody1'); // Update with your actual second table body ID
						tableBody1.empty(); // Clear existing rows

						var tableBody2 = $('#yourTableBody2'); // Update with your actual second table body ID
						tableBody2.empty(); // Clear existing rows

						var tableBody3 = $('#yourTableBody3'); // Update with your actual second table body ID
						tableBody3.empty(); // Clear existing rows

						fetchPendingApplicants();
						fetchRejectedApplicants();
						fetchApprovedApplicants();
					},
					error: function(xhr, status, error) {
						// Handle the error
						console.log(error);
					},
				});
			}
		}
	</script>

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

</body>

</html>