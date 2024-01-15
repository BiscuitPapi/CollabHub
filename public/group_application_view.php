<?php
	session_start();
	// Check if the session variable exists
	if (!isset($_SESSION['user_ID'])) {
		// Redirect to the login page
		header("Location: index.php");
		exit();
	}
	else {
		
		include("../assets/php/connection.php");

		if (isset($_GET['application_id'])) {
			$application_id = $_GET['application_id'];
	
			// Fetch the study hub profile based on the studyhub_ID
			$sql = "SELECT * FROM `group-application` WHERE application_ID = '$application_id'";
	
			// Execute the query
			$result = mysqli_query($connection, $sql);
	
			// Check if the query returned any rows
			if (mysqli_num_rows($result) > 0) {
				// Study hub profile found
				$groupapplication = mysqli_fetch_assoc($result);
				$department_name = $groupapplication['department_name'];
				$course_name = $groupapplication['course_name'];
				$project_name= $groupapplication['project_name'];
				$project_description = $groupapplication['project_description'];
				$skill_needed = $groupapplication['skill_needed'];
				$notes= $groupapplication['notes'];
				$application_date = $groupapplication['application_date'];
				$user_ID = $groupapplication['user_ID'];
				
				
			} else {
				// Study hub profile not found, handle the error
				echo "Group Application not found.";
			}
		} else {
			// Studyhub ID not provided, handle the error
			echo "Group Application ID is not provided.";
		}
  }

		
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content=""/>
		<meta name="author" content=""/>
		<title>Member Application Form</title>
		<!-- loader-->
		<link href="../assets/css/pace.min.css" rel="stylesheet"/>
		<script src="../assets/js/pace.min.js"></script>
		<!--favicon-->
		<link rel="icon" href="../assets/images/CB-favi.ico" type="image/x-icon">
		<!-- simplebar CSS-->
		<link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
		<!-- Bootstrap core CSS-->
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet"/>
		<!-- animate CSS-->
		<link href="../assets/css/animate.css" rel="stylesheet" type="text/css"/>
		<!-- Icons CSS-->
		<link href="../assets/css/icons.css" rel="stylesheet" type="text/css"/>
		<!-- Sidebar CSS-->
		<link href="../assets/css/sidebar-menu.css" rel="stylesheet"/>
		<!-- Custom Style-->
		<link href="../assets/css/app-style.css" rel="stylesheet"/>
		<style>
			.img-circle {
				border-radius: 50%;
				object-fit: cover; /* Maintain image aspect ratio */
				/* Add any additional styles or adjustments as needed */
			}
		</style>
	</head>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<body class="bg-theme bg-theme9">
		<div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
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
									<div class="card-title">Group Member Application Form</div>
									<hr>	

									<!--Group Application - Form-->
									<form action="../assets/php/open-application/process_editGroupApplication.php?application_ID=<?php echo $application_id; ?>" method="POST">
									<div class="form-group row">
										<label class="col-lg-3">Department Name</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" name = "department_name" value="<?php echo $department_name;?>" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3">Course Name</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" name="course_name" value="<?php echo $course_name;?>" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 ">Project Name</label>
										<div class="col-lg-9">
										<input class="form-control" type="text" name="project_name" value="<?php echo htmlspecialchars($project_name); ?>" <?php if ($_SESSION['user_ID'] != $user_ID) echo 'readonly'; ?>>

										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3">Project Description</label>
										<div class="col-lg-9">
										<input class="form-control" type="text" name="project_description" value="<?php echo $project_description; ?>" <?php if ($_SESSION['user_ID'] != $user_ID) echo 'readonly'; ?>>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3">Skill Needed</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" name="skill_needed" value="<?php echo $skill_needed; ?>" <?php if ($_SESSION['user_ID'] != $user_ID) echo 'readonly'; ?>>
											
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3">Notes</label>
										<div class="col-lg-9">
										<input class="form-control" type="text" name="notes" value="<?php echo $notes; ?>" <?php if ($_SESSION['user_ID'] != $user_ID) echo 'readonly'; ?>>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3">Date Created</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" name = "application_date" value="<?php echo $application_date;?>" readonly>
										</div>
									</div>
									
									
									
									<!-- Edit button - only available for application creator-->
									<?php
										if ($_SESSION['user_ID'] == $user_ID) {
											echo '<center><button type="submit" class="btn btn-primary px-5">Save Changes</button></center>';
										}
									?>

									<!-- Apply button - only avaiable for applicant -->
									<?php
										include("../assets/php/connection.php");


										if ($_SESSION['user_ID'] != $user_ID) {

											$sql = "SELECT * FROM `group_applicant_status` WHERE application_ID = '$application_id'";
											
											$result = mysqli_query($connection, $sql);

											if (mysqli_num_rows($result) == 0) {
												echo '<div style="display: flex; justify-content: center">';
												echo '<a href="../assets/php/open-application/process_applyGroupApplication.php?application_ID=' . $application_id . '" class="btn btn-success">Apply</a>';
												echo '<a href="javascript:history.back()" class="btn btn-light" style="margin-left: 10px">Back</a>';
												echo '</div>';
												
											} 
											else {
												echo '<div style="display: flex; justify-content: center">';
												echo '<a href="javascript:history.back()" class="btn btn-light">Back</a>';
												echo '</div>';
											}

											
										}
									?>
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
								<h5 class="card-title">Applicant List</h5>
								<div class="table-responsive">

								<table class="table table-hover">

									<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Name</th>
										<th scope="col">Profile</th>
										<th scope="col">Status</th>
										<th scope="col">Action</th>
									</tr>
									</thead>

									<tbody>
										<?php
											include("../assets/php/connection.php");
											$query = "SELECT u.name, gas.status, gas.application_ID, gas.applicant_ID
											FROM user u
											JOIN group_applicant_status gas ON u.user_ID = gas.applicant_ID
											WHERE gas.application_ID = '$application_id';";

											$result = mysqli_query($connection, $query);

											$count = 1; // Initialize count variable

											// Check if there are no mentees or no rows found
											if (mysqli_num_rows($result) == 0) {
												echo '<tr><td colspan="5">No applicants found.</td></tr>';
											} 
												
											else {
												while ($row = mysqli_fetch_assoc($result)) {

													echo'
														<tr>
														<th scope="row">' . $count . '</th>
														<td>' . $row['name'] . '</td>
														<td>
															<a href="group_application_view.php?application_ID=' . $row['application_id'] . '" class="btn btn-primary">View</a>
														</td>
														<td>' . $row['status'] . '</td>
														<td>';
														// Check if status is 'pending' to show the buttons
														if ($row['status'] == 'pending') {
															echo '
															<a href="../assets/php/process_approveGroupApplication.php?application_ID=' . $row['application_ID'] . '&applicant_ID=' . $row['applicant_ID'] . '" class="btn btn-success">Approve</a>
															<a href="../assets/php/process_rejectGroupApplication.php?application_ID=' . $row['application_ID'] . '&applicant_ID=' . $row['applicant_ID'] . '" class="btn btn-warning">Reject</a>';
														}
														echo '
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
							<?php
							} // Close the if statement
							?>
        				</div>

						<div class="overlay toggle-menu"></div>
					</div>
				</div>
			</div>
			<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
		
			<footer class="footer">
				<div class="container">
					<div class="text-center">
					</div>
				</div>
			</footer>
		</div>


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
    
		<script>
			displayNotifications();
		</script>					
	</body>
</html>

