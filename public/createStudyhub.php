<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Create StudyHub</title>
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
		.img-circle {
			border-radius: 50%;
			object-fit: cover;
			/* Maintain image aspect ratio */
			/* Add any additional styles or adjustments as needed */
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
								<div class="card-title">Create StudyHub</div>
								<hr>
								<!--Group Application - Form-->
								<form action="../assets/php/studyhub/process_createStudyHub.php" method="POST" id = "SBform">
									<!-- <div> -->
									<!--StudyHub Name-->
									<div class="form-group">
										<label for="input-1">StudyHub Name:</label>
										<input type="text" class="form-control" id="input-1" name="studyhub_name" placeholder="Enter the Studyhub name" required>
									</div>

									<!--StudyHub Description-->
									<div class="form-group">
										<label for="input-2">StudyHub Description:</label>
										<input type="text" class="form-control" id="input-2" name="studyhub_description" placeholder="Enter the description" required>
									</div>

									<!--Settings-->
									<div class="form-group">
										<label for="input-3">StudyHub Settings:</label>

										<input type="radio" id="option1" name="setting" value="Open StudyHub">
										<label for="option1">Open StudyHub</label>

										<input type="radio" id="option2" name="setting" value="Close StudyHub">
										<label for="option2">Close StudyHub</label>
									</div>

									<!--Submit Button - Create StudyHub-->
									<div class="form-group">
										<button type="submit" class="btn btn-success px-5" style="width: 100%;" ">Create StudyHub</button>
									</div>

								</form>
							</div>
						</div>
					</div>
					<div class=" overlay toggle-menu">
									</div>
							</div>
						</div>
					</div>
					<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
					<script>
						const form = document.getElementById('SBform');
						form.addEventListener('submit', function(event) {
							// Prevent the form from submitting
							event.preventDefault();

							// Get the value of the selected radio button
							const selectedSetting = document.querySelector('input[name="setting"]:checked');

							if (selectedSetting) {
								// Log the value to the console (you can use it as needed)
								console.log('Selected Setting:', selectedSetting.value);
								form.submit();
							} else {
								// Handle the case when no radio button is selected
								alert("Please select the setting.");
								document.getElementById("option1").focus();
							}
						});

						

					</script>
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
				<script src="../assets/js/notification.js"></script>

				<script>
					displayNotifications();
				</script>
</body>

</html>