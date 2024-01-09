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

		if (isset($_GET['studysession_id'])) {
			$studysession_id = $_GET['studysession_id'];
	
			// Fetch the study hub profile based on the studyhub_ID
			$sql = "SELECT * FROM `study_session` WHERE studysession_id = '$studysession_id'";
	
			// Execute the query
			$result = mysqli_query($connection, $sql);
	
			// Check if the query returned any rows
			if (mysqli_num_rows($result) > 0) {

				$studysession = mysqli_fetch_assoc($result);
				// $studyhub_ID = $_POST['studyhub_ID'];
				$studysession_name = $studysession['studysession_name'];
				$studysession_date = $studysession['studysession_date'];
				$studysession_time = $studysession['studysession_time'];
				$studysession_mode = $studysession['studysession_mode'];
				$studysession_link = $studysession['studysession_link'];
				$note = $studysession['note'];
				$created_on = $studysession['created_on'];
				$created_by = $studysession['created_by'];

	
				
			} else {
				// Study hub profile not found, handle the error
				echo "Study session not found.";
			}
		} else {
			// Studyhub ID not provided, handle the error
			echo "Study session ID is not provided.";
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

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
									<div class="card-title">Study Session Information</div>
									<hr>	

									<!--Group Application - Form-->
									<form action="assets/php/process_editStudySession.php?studysession_id=<?php echo $studysession_id; ?>" method="POST">
									<div class="form-group row">
										<label class="col-lg-3">Session Name</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" name = "studysession_name" value="<?php echo $studysession_name;?>" <?php if ($_SESSION['user_ID'] != $created_by) echo 'readonly'; ?>>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3">Session Date</label>
										<div class="col-lg-9">
											<input class="form-control" type="date" name="studysession_date" value="<?php echo $studysession_date;?>" <?php if ($_SESSION['user_ID'] != $created_by) echo 'readonly'; ?>>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 ">Session Time</label>
										<div class="col-lg-9">
											<input class="form-control" type="time" name="studysession_time" value="<?php echo $studysession_time;?>" <?php if ($_SESSION['user_ID'] != $created_by) echo 'readonly'; ?>>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3">Session Mode</label>
										<div class="col-lg-9">

											<?php
												if ($_SESSION['user_ID'] == $created_by) {
													echo '<input type="radio" id="option1" name="studysession_mode" value="Online" ' . ($studysession_mode === 'Online' ? 'checked' : '') . '>
													<label for="option1">Online</label>
													&nbsp;&nbsp;
													<input type="radio" id="option2" name="studysession_mode" value="Physical" ' . ($studysession_mode === 'Physical' ? 'checked' : '') . '>
													<label for="option2">Physical</label>';
												} else {
													echo '<input class="form-control" type="text" name="studysession_mode" value="' . $studysession_mode . '" ' . ($_SESSION['user_ID'] != $created_by ? 'readonly' : '') . '>';
												}
											?>
											

										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3">Session Link</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" name = "studysession_link" value="<?php echo $studysession_link;?>" <?php if ($_SESSION['user_ID'] != $created_by) echo 'readonly'; ?>>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3">Note</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" name = "note" value="<?php echo $note;?>" <?php if ($_SESSION['user_ID'] != $created_by) echo 'readonly'; ?>>
										</div>
									</div>
									
									<?php
										if ($_SESSION['user_ID'] == $created_by) {
											echo '<center><button type="submit" class="btn btn-light px-5">Edit</button></center>';
										}
										else {
											echo '<center><a href="javascript:history.back()" class="btn btn-light" style="margin-left: 10px">Back</a></center>';
										}
									?>
									
										
								</div>
							</div>
						</div>

						<!-- <div class="col-lg-6">
							<div class="card">
								<div class="card-body">
								<h5 class="card-title">Applicant List</h5>
								<div class="table-responsive">
								<table class="table table-hover">
									<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Name</th>
										<th scope="col">Action</th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<th scope="row">1</th>
										<td>Mark</td>
										<td>Otto</td>
									</tr>
									<tr>
										<th scope="row">2</th>
										<td>Jacob</td>
										<td>Thornton</td>
									</tr>
									<tr>
										<th scope="row">3</th>
										<td colspan="2">Larry the Bird</td>
									</tr>
									</tbody>
								</table>
								</div>
								</div>
							</div>
        				</div> -->

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
		<script src="assets/js/inviteMM.js"></script>
    
		
	</body>
</html>

