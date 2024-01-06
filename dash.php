<?php
session_start();
// Check if the session variable exists
if (!isset($_SESSION['user_ID'])) {
	// Redirect to the login page
	header("Location: login.php");
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
		<title>Dashboard</title>
		<!-- loader-->
		<link href="assets/css/pace.min.css" rel="stylesheet" />
		<script src="assets/js/pace.min.js"></script>
		<!--favicon-->
		<link rel="icon" href="assets/images/CB-favi.ico" type="image/x-icon">
		<!-- simplebar CSS-->
		<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
		<!-- Bootstrap core CSS-->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<!-- animate CSS-->
		<link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
		<!-- Icons CSS-->
		<link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
		<!-- Sidebar CSS-->
		<link href="assets/css/sidebar-menu.css" rel="stylesheet" />
		<!-- Custom Style-->
		<link href="assets/css/app-style.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/modally.css">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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
			<?php include_once('sidebar.php'); ?>
			<?php include_once('topbar.php'); ?>

			<div class="clearfix"></div>
			<!--Start Content Wrapper-->
			<div class="content-wrapper">
				<div class="container-fluid">
					<!--Start Dashboard Content-->
					<div class="card mt-3">
						<div class="card-content">
							<div class="row row-group m-0">
								<div class="col-12 col-lg-6 col-xl-3 border-light">
									<div class="card-body">
										<h5 class="text-white mb-0">10 <span class="float-right"><i
													class="zmdi zmdi-account-o"></i></span></h5>
										<div class="progress my-3" style="height:3px;">
											<div class="progress-bar" style="width:55%"></div>
										</div>
										<p class="mb-0 text-white small-font">New Users<span class="float-right">+4.2%
												<i class="zmdi zmdi-long-arrow-up"></i></span></p>
									</div>
								</div>
								<div class="col-12 col-lg-6 col-xl-3 border-light">
									<div class="card-body">
										<h5 class="text-white mb-0">5 <span class="float-right"><i
													class="zmdi zmdi-assignment"></i></span></h5>
										<div class="progress my-3" style="height:3px;">
											<div class="progress-bar" style="width:55%"></div>
										</div>
										<p class="mb-0 text-white small-font">Open Applications<span
												class="float-right">+1.2%
												<i class="zmdi zmdi-long-arrow-up"></i></span></p>
									</div>
								</div>
								<div class="col-12 col-lg-6 col-xl-3 border-light">
									<div class="card-body">
										<h5 class="text-white mb-0">20 <span class="float-right"><i
													class="fa fa-eye"></i></span></h5>
										<div class="progress my-3" style="height:3px;">
											<div class="progress-bar" style="width:55%"></div>
										</div>
										<p class="mb-0 text-white small-font">StudyHub<span class="float-right">+5.2% <i
													class="zmdi zmdi-long-arrow-up"></i></span></p>
									</div>
								</div>
								<div class="col-12 col-lg-6 col-xl-3 border-light">
									<div class="card-body">
										<h5 class="text-white mb-0">102 <span class="float-right"><i
													class="zmdi zmdi-help-outline"></i></span></h5>
										<div class="progress my-3" style="height:3px;">
											<div class="progress-bar" style="width:55%"></div>
										</div>
										<p class="mb-0 text-white small-font">Messages <span class="float-right">+2.2% <i
													class="zmdi zmdi-long-arrow-up"></i></span></p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-lg-12">
							<!-- SWITCH BUTTON -->
							<div class="row" style="justify-content: center; align-items: center; margin-bottom: 20px;">
								<button class="btn btn-primary" id="list_1Button"
									onclick="togglePage('list_1')">StudyHub</button>
								<button class="btn btn-dark" id="list_2Button" onclick="togglePage('list_2')">Open
									Application</button>
							</div>
							<div class="card" id="list_1">
								<div class="card-header">StudyHub List
									<div class="card-action">
										<div class="dropdown">
											<a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret"
												data-toggle="dropdown">
												<i class="icon-options"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="javascript:void();">Action</a>
												<a class="dropdown-item" href="javascript:void();">Another action</a>
												<a class="dropdown-item" href="javascript:void();">Something else here</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" href="javascript:void();">Separated link</a>
											</div>
										</div>
									</div>
								</div>

								<div class="table-responsive">
									<table class="table align-items-center table-flush table-borderless">
										<thead>
											<tr>
												<th>#</th>
												<th>StudyHub</th>
												<th style="text-align: center;">Creator</th>
												<th style="text-align: center;">No. of Members</th>
												<th style="text-align: center;">Action</th>
											</tr>
										</thead>
										<tbody id="yourTableBody">
											<!-- Table rows will be dynamically added here -->
										</tbody>

									</table>
									<div class="col-md-12">
										<ul class="pagination justify-content-center">
											<!-- Pagination Links -->
											<div class="pagination">
												<!-- Pagination links will be dynamically added here -->
											</div>
										</ul>
									</div>

								</div>


							</div>

							<div class="card" id="list_2" style="display:none;">
								<div class="card-header">Open Application List
									<div class="card-action">
										<div class="dropdown">
											<a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret"
												data-toggle="dropdown">
												<i class="icon-options"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="javascript:void();">Action</a>
												<a class="dropdown-item" href="javascript:void();">Another action</a>
												<a class="dropdown-item" href="javascript:void();">Something else here</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" href="javascript:void();">Separated link</a>
											</div>
										</div>
									</div>
								</div>

								<div class="table-responsive">
									<table class="table align-items-center table-flush table-borderless">
										<thead>
											<tr>
												<th>#</th>
												<th>Club Name</th>
												<th>Position Available</th>
												<th>Created</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="yourTableBody2">
											<!-- Table rows will be dynamically added here -->
										</tbody>

									</table>

								</div>


							</div>




						</div>
					</div><!--End Row-->
					<!--End Dashboard Content-->
				</div>
				<!--End content-wrapper-->



				<!--Start footer-->
				<footer class="footer">
					<div class="container">
						<div class="text-center">
						</div>
					</div>
				</footer>
				<!--End footer-->
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
			<script src="assets/js/inviteMM.js"></script>
			<script src="assets/js/sB-4.js"></script>
			<script>
				displayNotifications();
			</script>

	</body>

	</html>

	<?php
}
?>