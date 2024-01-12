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
		<title>Login</title>
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
			<div class="loader-wrapper">
				<div class="lds-ring">
					<div></div>
					<div></div>
					<div></div>
					<div></div>
				</div>
			</div>
			<div class="card card-authentication1 mx-auto my-5">
				<div class="card-body">
					<div class="card-content p-2">
						<div class="text-center">
							<img src="../assets/images/collabHub1-icon.png" alt="logo icon">
						</div>

						<div class="card-title text-uppercase text-center py-3">Sign In</div>

						<!----  Form  ---->
						<form id="loginForm" method="POST">
							<!----  Email  ---->
							<div class="form-group">
								<label for="exampleInputUsername" class="sr-only">Username</label>
								<div class="position-relative has-icon-right">
									<input type="email" id="email" name="email" class="form-control input-shadow"
										placeholder="Enter Email" required>
									<div class="form-control-position">
										<i class="icon-envelope-open"></i>
									</div>
								</div>
							</div>

							<!----  Password  ---->
							<div class="form-group">
								<label for="exampleInputPassword" class="sr-only">Password</label>
								<div class="position-relative has-icon-right">
									<input type="password" id="password" name="password" class="form-control input-shadow"
										placeholder="Choose Password" required>
									<div class="form-control-position">
										<i class="icon-lock"></i>
									</div>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-6">
									<div class="icheck-material-white">
										<input type="checkbox" id="user-checkbox" checked="" />
										<label for="user-checkbox">Remember me</label>
									</div>
								</div>

								<div class="form-group col-6 text-right">
									<a href="reset-password.php">Reset Password</a>
								</div>
							</div>
							<center>
							<button type="submit" value="submit" class="btn btn-success" style="width: 100%;">Sign In</button></center>
						</form>
					</div>
				</div>
				<div class="card-footer text-center py-3">
					<p class="text-warning mb-0">Do not have an account? <a href="register.php"> Sign Up here</a></p>
				</div>
			</div>

			<!--Start Back To Top Button-->
			<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
			<!--End Back To Top Button-->


			<script>
				document.getElementById('loginForm').addEventListener('submit', function (event) {
					event.preventDefault();
					login();
				});

				function login() {
					var email = document.getElementById('email').value;
					var password = document.getElementById('password').value;

					var xhr = new XMLHttpRequest();
					xhr.open('POST', '../assets/php/process_login.php', true);
					xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					xhr.onreadystatechange = function () {
						if (xhr.readyState === XMLHttpRequest.DONE) {
							if (xhr.status === 200) {
								var response = xhr.responseText;
								if (response === 'success') {
									window.location.href = 'myProfile.php';
								} else {
									alert('Incorrect email and/or password');
								}
							} else {
								alert('An error occurred. Please try again.');
							}
						}
					};

					xhr.send('email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password));
				}
			</script>



			</script>

		</div><!--wrapper-->

		<!-- Bootstrap core JavaScript-->
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/popper.min.js"></script>
		<script src="../assets/js/bootstrap.min.js"></script>

		<!-- sidebar-menu js -->
		<script src="../assets/js/sidebar-menu.js"></script>

		<!-- Custom scripts -->
		<script src="../assets/js/app-script.js"></script>

	</body>

	</html>


	<?php
}
?>