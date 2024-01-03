<?php
  session_start();
  
  // Check if the session variable exists
	if (!isset($_SESSION['user_ID'])) {
		// Redirect to the login page
		header("Location: login.html");
		exit();
	}
	else {
		
		include("assets/php/connection.php");

		if (isset($_GET['application_ID'])) {
			$application_id = $_GET['application_ID'];
	
			// Fetch the study hub profile based on the studyhub_ID
			$sql = "SELECT * FROM `club-application` WHERE club_id = '$application_id'";
	
			// Execute the query
			$result = mysqli_query($connection, $sql);
	
			// Check if the query returned any rows
			if (mysqli_num_rows($result) > 0) {
				// Study hub profile found
				$clubapplication = mysqli_fetch_assoc($result);
				$club_name = $clubapplication['club_name'];
				$club_description = $clubapplication['club_description'];
				$position_available = $clubapplication['position_available'];
				$skill_needed = $clubapplication['skill_needed'];
				$notes= $clubapplication['notes'];
				$application_date = $clubapplication['application_date'];
				$user_ID = $clubapplication['user_ID'];
	
				
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
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content=""/>
		<meta name="author" content=""/>
		<title>Create Club/Association</title>
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
	</head>

	<body class="bg-theme bg-theme9">
		<div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
		<div id="wrapper">
			<?php include_once('sidebar.php'); ?>
			<?php include_once('topbar.php'); ?>


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
									<form action="assets/php/process_editClubApplication.php?application_ID=<?php echo $application_id; ?>" method="POST">

										<!--Club Name-->
										<div class="form-group">
											<label for="input-1">Club Name:</label>
											<input type="text" class="form-control" id="input-1" name ="club_name" value="<?php echo $club_name; ?>" <?php if ($_SESSION['user_ID'] != $user_ID) echo 'readonly'; ?>>
										</div>

										<!--Club Description-->
										<div class="form-group">
											<label for="input-2">Club Description:</label>
											<input type="text" class="form-control" id="input-2" name ="club_description" value="<?php echo $club_description; ?>" <?php if ($_SESSION['user_ID'] != $user_ID) echo 'readonly'; ?>>
										</div>

										<!--Position Available-->
										<div class="form-group">
											<label for="input-3">Position Available:</label>
											<input type="text" class="form-control" id="input-3" name ="position_available" value="<?php echo $position_available; ?>" <?php if ($_SESSION['user_ID'] != $user_ID) echo 'readonly'; ?>>
										</div>

										<!--Skill Wanted-->
										<div class="form-group">
											<label for="input-4">Skill Wanted:</label>
											<input type="text" class="form-control" id="input-4" name ="skill_needed" value="<?php echo $skill_needed; ?>" <?php if ($_SESSION['user_ID'] != $user_ID) echo 'readonly'; ?>>
										</div>

										<div class="form-group">
											<label for="input-6">Notes:</label>
											<input type="text" class="form-control" id="input-6" name ="notes" value="<?php echo $notes; ?>" <?php if ($_SESSION['user_ID'] != $user_ID) echo 'readonly'; ?>>
										</div>
									  
										<!-- Edit button - only available for application creator-->
										<?php
											if ($_SESSION['user_ID'] == $user_ID) {
												echo '<center><button type="submit" class="btn btn-secondary px-5">Edit</button></center>';
											}
										?>

										<!-- Apply button - only avaiable for applicant -->
										<?php
											include("assets/php/connection.php");


											if ($_SESSION['user_ID'] != $user_ID) {

												$sql = "SELECT * FROM `club_applicant_status` WHERE application_ID = '$application_id'";
												
												$result = mysqli_query($connection, $sql);

												if (mysqli_num_rows($result) == 0) {
													echo '<div style="display: flex; justify-content: center">';
													echo '<a href="assets/php/process_applyClubApplication.php?application_ID=' . $application_id . '" class="btn btn-success">Apply</a>';
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


									</form>
								</div>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="card">
								<?php
								include("assets/php/connection.php");

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
											include("assets/php/connection.php");
											$query = "SELECT u.name, cas.status, cas.application_ID, cas.applicant_ID
											FROM user u
											JOIN club_applicant_status cas ON u.user_ID = cas.applicant_ID
											WHERE cas.application_ID = '$application_id';";

											$result = mysqli_query($connection, $query);

											$count = 1; // Initialize count variable

											// Check if there are no mentees or no rows found
											if (mysqli_num_rows($result) == 0) {
												echo '<tr><td colspan="4">No applicants found.</td></tr>';
											} 
												
											else {
												while ($row = mysqli_fetch_assoc($result)) {

													echo'
														<tr>
														<th scope="row">' . $count . '</th>
														<td>' . $row['name'] . '</td>
														<td>
															<a href="group_application_view.php?application_ID=' . $row['application_ID'] . '" class="btn btn-info">View</a>
														</td>
														<td>' . $row['status'] . '</td>
														<td>';
														// Check if status is 'pending' to show the buttons
														if ($row['status'] == 'Pending') {
															echo '
															<a href="assets/php/process_approveClubApplication.php?application_ID=' . $row['application_ID'] . '&applicant_ID=' . $row['applicant_ID'] . '" class="btn btn-success">Approve</a>
															<a href="assets/php/process_rejectClubApplication.php?application_ID=' . $row['application_ID'] . '&applicant_ID=' . $row['applicant_ID'] . '" class="btn btn-warning">Reject</a>';
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
			<script src="assets/js/notification.js"></script>
    
			<script>
				displayNotifications();
			</script>
			<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
		
			<footer class="footer">
				<div class="container">
					<div class="text-center">
					</div>
				</div>
			</footer>
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
		</div>


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
		
	</body>
</html>

