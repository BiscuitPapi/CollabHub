<?php
	session_start();
	// Check if the session variable exists
	if (isset($_SESSION['user_ID'])) {
		// Redirect to the login page
		header("Location: myProfile.php");
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
		<title>Register</title>
		<!-- loader-->
		<link href="assets/css/pace.min.css" rel="stylesheet"/>
		<script src="assets/js/pace.min.js"></script>
		<!--favicon-->
		<link rel="icon" href="assets/images/CB-favi.ico" type="image/x-icon">
		<!-- Bootstrap core CSS-->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
		<!-- animate CSS-->
		<link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
		<!-- Icons CSS-->
		<link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
		<!-- Custom Style-->
		<link href="assets/css/app-style.css" rel="stylesheet"/>
	</head>

	<body class="bg-theme bg-theme9">
		<!-- start loader -->
		<div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
		<!-- end loader -->

		<!-- Start wrapper-->
		<div id="wrapper">
			<div class="card card-authentication1 mx-auto my-4 w-50">
				<div class="card">
					<div class="card-body">
						<div class="card-title">Registration</div>
						<hr>
						
						<!-- FORM -->
						<form method="POST" action="assets/php/process_registration.php">
							<div class="form-group">
								<label for="input-1">Name</label>
								<input type="text" class="form-control" name = "name" id = "name" placeholder="Enter Your Name">
							</div>
							
							<div class="form-group">
								<label for="input-2">Email</label>
								<input type="email" class="form-control" name = "email" id = "email" placeholder="Enter Your Email Address">
							</div>
							
							<div class="form-group">
								<label for="input-3">Matric Number</label>
								<input type="text" class="form-control" name = "matricNum" id = "matricNum" placeholder="Enter Your Matric Number">
							</div>
							
							<div class="form-group">
								<label for="input-3">Mobile</label>
								<input type="text" class="form-control" name = "mobile" id = "mobile" placeholder="Enter Your Mobile Number">
							</div>
							
							<div class="form-group">
								<label for="input-4">Password</label>
								<input type="password" class="form-control" name = "password" id = "password" placeholder="Enter Password">
							</div>
							
							<div class="form-group">
								<label for="input-5">Confirm Password</label>
								<input type="password" class="form-control" name = "confirmPassword" id = "confirmPassword" placeholder="Confirm Password">
							</div>
							
							<div class="form-group py-2">
								<div class="icheck-material-white">
									<input type="checkbox" id="user-checkbox1" checked=""/>
									<label for="user-checkbox1">I Agree Terms & Conditions</label>
								</div>
							</div>
							
							<div class="form-group">
								<center><button type="submit" id="submit-button" value = "submit" class="btn btn-light px-5"><i class="icon-lock"></i> Register</button></center>
							</div>
						</form>
					</div>
					<div class="card-footer text-center py-3">
						<p class="text-warning mb-0">Already have an account? <a href="login.php"> Sign In here</a></p>
					</div>
				</div>
			</div>
			
			<script>
				document.getElementById("submit-button").addEventListener("click", function(event) {
					if (!document.getElementById("user-checkbox1").checked) {
						event.preventDefault(); // prevent form submission
						alert("Please agree to the terms and conditions before submitting the form.");
					}
				});
				
				const form = document.querySelector('form');
				const passwordField = document.getElementById('password');
				const confirmPasswordField = document.getElementById('confirmPassword');

				form.addEventListener('submit', function(event) {
				  const passwordValue = passwordField.value;
				  const confirmPasswordValue = confirmPasswordField.value;
				  
				  if (passwordValue !== confirmPasswordValue) {
					event.preventDefault();
					alert('Passwords do not match. Please try again.');
				  }
				});



				const emailField = document.getElementById('email');

				emailField.addEventListener('blur', function() {
				  const emailValue = emailField.value;
				  
				  const xhr = new XMLHttpRequest();
				  xhr.open('POST', 'assets/php/check_email.php', true);
				  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				  xhr.onreadystatechange = function() {
					if (xhr.readyState == 4 && xhr.status == 200) {
					  const response = xhr.responseText;
					  if (response !== '') {
						alert(response);
						emailField.value = '';
						emailField.focus();
					  }
					}
				  };
				  xhr.send('email=' + emailValue);
				});

			</script>
			
			
			
			
			<!--Start Back To Top Button-->
			<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
			<!--End Back To Top Button-->
		
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
		
		</div><!--wrapper-->
		
		<!-- Bootstrap core JavaScript-->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- sidebar-menu js -->
		<script src="assets/js/sidebar-menu.js"></script>
	  
		<!-- Custom scripts -->
		<script src="assets/js/app-script.js"></script>
	  
	</body>
</html>

	<?php
	}
?>
