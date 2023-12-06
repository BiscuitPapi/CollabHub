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
										<h5 class="text-white mb-0">9526 <span class="float-right"><i
													class="fa fa-shopping-cart"></i></span></h5>
										<div class="progress my-3" style="height:3px;">
											<div class="progress-bar" style="width:55%"></div>
										</div>
										<p class="mb-0 text-white small-font">Total Orders <span class="float-right">+4.2%
												<i class="zmdi zmdi-long-arrow-up"></i></span></p>
									</div>
								</div>
								<div class="col-12 col-lg-6 col-xl-3 border-light">
									<div class="card-body">
										<h5 class="text-white mb-0">8323 <span class="float-right"><i
													class="fa fa-usd"></i></span></h5>
										<div class="progress my-3" style="height:3px;">
											<div class="progress-bar" style="width:55%"></div>
										</div>
										<p class="mb-0 text-white small-font">Total Revenue <span class="float-right">+1.2%
												<i class="zmdi zmdi-long-arrow-up"></i></span></p>
									</div>
								</div>
								<div class="col-12 col-lg-6 col-xl-3 border-light">
									<div class="card-body">
										<h5 class="text-white mb-0">6200 <span class="float-right"><i
													class="fa fa-eye"></i></span></h5>
										<div class="progress my-3" style="height:3px;">
											<div class="progress-bar" style="width:55%"></div>
										</div>
										<p class="mb-0 text-white small-font">Visitors <span class="float-right">+5.2% <i
													class="zmdi zmdi-long-arrow-up"></i></span></p>
									</div>
								</div>
								<div class="col-12 col-lg-6 col-xl-3 border-light">
									<div class="card-body">
										<h5 class="text-white mb-0">5630 <span class="float-right"><i
													class="fa fa-envira"></i></span></h5>
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
												<th style="text-align: center;">Members</th>
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
			<script src="assets/js/notification.js"></script>

			<script>
				displayNotifications();

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


				$(document).ready(function () {
					function loadTables(page) {
						// Fetch data for the first table
						$.ajax({
							url: 'assets/php/process_fetchSB.php?page=' + page,
							type: 'GET',
							dataType: 'json',
							success: function (data) {
								var tableBody = $('#yourTableBody'); // Update with your actual table body ID
								tableBody.empty(); // Clear existing rows

								for (var i = 0; i < data.length; i++) {
									var row = data[i];
									var html = '<tr>' +
										'<th scope="row">' + (i + 1) + '</th>' +
										'<td>' + row['studyhub_name'] + '</td>' +
										'<td style="text-align: center;">' + row['creator_name'] + '</td>' +
										'<td style="text-align: center;">' +
										row['member_count'] + // Display the member count
										'</td>' +
										'<td style="text-align: center;">' +
										'<a href="viewStudyHub.php?studyhub_ID=' + row['studyhub_ID'] + '" class="btn btn-success">View</a>' +
										'</td>' +
										'</tr>';

									tableBody.append(html);
								}
							}
						});

						// Fetch data for the second table
						$.ajax({
							url: 'assets/php/process_fetchOA.php?page=' + page,
							type: 'GET',
							dataType: 'json',
							success: function (data) {
								console.log(data); // Display the fetched data in the console

								var tableBody2 = $('#yourTableBody2'); // Update with your actual second table body ID
								tableBody2.empty(); // Clear existing rows

								for (var i = 0; i < data.length; i++) {
									var row = data[i];
									var html = '<tr>' +
										'<th scope="row">' + (i + 1) + '</th>' +
										'<td>' + row['club_name'] + '</td>' +
										'<td>' + row['position_available'] + '</td>' +
										'<td>' +
										'<a href="club_application_view.php?application_ID=' + row['club_id'] + '" class="btn btn-success">View</a>' +
										'</td>' +
										// Add other table columns as needed
										'</tr>';

									tableBody2.append(html);
								}
							},
							error: function (xhr, status, error) {
								console.error(xhr.responseText); // Log any error response to the console
							}
						});




					}

					// Initial table load
					$(document).ready(function () {
						loadTables(1);

						// Handle pagination clicks
						$(document).on('click', '.pagination a', function (e) {
							e.preventDefault();
							var page = $(this).text();
							loadTables(page);
						});
					});


				});



			</script>

	</body>

	</html>

	<?php
}
?>