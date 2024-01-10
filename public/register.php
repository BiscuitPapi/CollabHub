<?php
session_start();
// Check if the session variable exists
if (isset($_SESSION['user_ID'])) {
	// Redirect to the login page
	header("Location: myProfile.php");
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
		<title>Register</title>
		<!-- loader-->
		<link href="../assets/css/pace.min.css" rel="stylesheet" />
		<script src="../assets/js/pace.min.js"></script>
		<!--favicon-->
		<link rel="icon" href="../assets/images/CB-favi.ico" type="image/x-icon">
		<!-- Bootstrap core CSS-->
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
		<!-- animate CSS-->
		<link href="../assets/css/animate.css" rel="stylesheet" type="text/css" />
		<!-- Icons CSS-->
		<link href="../assets/css/icons.css" rel="stylesheet" type="text/css" />
		<!-- Custom Style-->
		<link href="../assets/css/app-style.css" rel="stylesheet" />
	</head>

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
			<div class="card card-authentication1 mx-auto my-4 w-50">
				<div class="card">
					<div class="card-body">
						<div class="card-title">Registration</div>
						<hr>

						<!-- FORM -->
						<div>
							<div class="form-group">
								<label for="input-1">Name</label>
								<input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name"
									required>
							</div>

							<div class="form-group">
								<label for="input-2">Email</label>
								<input type="email" class="form-control" name="email" id="email"
									placeholder="Enter Your Email Address" required>
							</div>

							<div class="form-group">
								<label for="input-3">Matric Number</label>
								<input type="text" class="form-control" name="matricNum" id="matricNum"
									placeholder="Enter Your Matric Number" required>
							</div>

							<div class="row">
								<div class="col">
									<!-- Year -->
									<div class="form-group">
										<label for="year">Year</label>
										<div class="position-relative has-icon-right">
											<select id="year" name="year" class="form-control input-shadow" required>
												<option value="1st Year">1st Year</option>
												<option value="2nd Year">2nd Year</option>
												<option value="3rd Year">3rd Year</option>
												<option value="4th Year">4th Year</option>
											</select>
										</div>
									</div>

								</div>


								<div class="col">
									<!-- Department -->
									<div class="form-group">
										<label for="input-1">Department</label>
										<div class="position-relative has-icon-right">
											<select id="department" name="department" class="form-control input-shadow"
												required>
												<option value="Computer System & Network">Computer
													System & Network</option>
												<option value="Artificial Intelligence">Artificial
													Intelligence</option>
												<option value="Information Systems">Information Systems
												</option>
												<option value="Software Engineering">Software
													Engineering</option>
												<option value="Multimedia Computing">Multimedia
													Computing</option>
												<option value="Data Science">Data Science</option>
											</select>
										</div>
									</div>


								</div>
							</div>


							<div class="form-group">
								<label for="input-3">Mobile</label>
								<input type="text" class="form-control" name="mobile" id="mobile"
									placeholder="Enter Your Mobile Number" required>
							</div>

							<div class="row">
								<div class="col">
									<div class="form-group">
										<label for="input-4">Password</label>
										<input type="password" class="form-control" name="password" id="password"
											placeholder="Enter Password" required>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="input-5">Confirm Password</label>
										<input type="password" class="form-control" name="confirmPassword"
											id="confirmPassword" placeholder="Confirm Password" required>
									</div>
								</div>
							</div>

							<div class="form-group py-2">
								<div class="icheck-material-white">
									<input type="checkbox" id="user-checkbox1" checked="" />
									<label for="user-checkbox1">I Agree Terms & Conditions</label>
								</div>
							</div>

							<div class="form-group">
								<center><button id="submit-button" class="btn btn-success"><i class="icon-lock"></i>
										Register</button></center>
							</div>
						</div>
					</div>
					<div class="card-footer text-center py-3">
						<p class="text-warning mb-0">Already have an account? <a href="login.php"> Sign In here</a></p>
					</div>
				</div>
			</div>


			<!--Start Back To Top Button-->
			<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
			<!--End Back To Top Button-->

		</div><!--wrapper-->

		<!-- Bootstrap core JavaScript-->
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/popper.min.js"></script>
		<script src="../assets/js/bootstrap.min.js"></script>

		<!-- sidebar-menu js -->
		<script src="../assets/js/sidebar-menu.js"></script>

		<!-- Custom scripts -->
		<script src="../assets/js/app-script.js"></script>
		<script src="../assets/js/registration-1.js"></script>

	</body>

	</html>

	<?php
}
?>