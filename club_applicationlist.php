<?php
session_start();

?>



<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content=""/>
		<meta name="author" content=""/>
		<title>My StudyHub</title>
		<!-- loader-->
		<link href="assets/css/pace.min.css" rel="stylesheet"/>
		<script src="assets/js/pace.min.js"></script>
		<!--favicon-->
		<link rel="icon" href="assets/images/CB-favi.ico" type="image/x-icon">
		<!-- Vector CSS -->
		<link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
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
		
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<style>
			.modal {
			display: none;
			position: fixed;
			z-index: 1;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			overflow: auto;
			background-color: rgba(0, 0, 0, 0.5);
			}

			.modal-content {
			background-color: #fefefe;
			margin: 20% auto;
			padding: 20px;
			border: 1px solid #888;
			width: 300px;
			text-align: center;
			}

			.button-container {
			margin-top: 20px;
			}

			.btn-danger {
			background-color: #dc3545;
			color: #fff;
			}

			.btn-secondary {
			background-color: #6c757d;
			color: #fff;
			}
			.img-circle {
				border-radius: 50%;
				object-fit: cover; /* Maintain image aspect ratio */
				/* Add any additional styles or adjustments as needed */
			}
		</style>
		<script>
			function deleteStudyHub(studyhubID) {
				var confirmed = confirm("Are you sure you want to delete this StudyHub?");

				if (!confirmed) {
					return;
				}

				// Make an AJAX request to your server-side PHP script to delete the studyhub
				$.ajax({
					url: 'assets/php/delete_studyhub.php',
					method: 'GET',
					data: { studyhub_ID: studyhubID },
					success: function(response) {
						// Handle the response from the PHP script
						console.log(response);
						if (response === "Studyhub deleted successfully!") {
							// Studyhub deletion was successful
							alert(response);
							// Perform any necessary UI updates or redirects
							window.location.reload(); // Refresh the page to update the studyhub list
						} else {
							// Studyhub deletion failed
							alert(response);
							// Perform any necessary error handling
						}
					},
					error: function(xhr, status, error) {
						// Handle the error
						console.log(error);
					}
				});
			}

		
		</script>

	</head>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<body class="bg-theme bg-theme9">
 
		<!-- Start wrapper-->
		<div id="wrapper">
			<?php include_once('sidebar.php'); ?>
			<?php include_once('topbar.php'); ?>

			<div class="clearfix"></div>
		
			<div class="content-wrapper">
				<div class="container-fluid">

				<!--Start Dashboard Content-->
			  

				<!--Group Application List-->

					<div class="row">
						
						<div class="col-12 col-lg-12">
							<div class="card">
								<!--Top Table-->
								<div class="card-header">Club Application List
									<!-- Drop down Menu Option
									<div class="card-action">
										<div class="dropdown">
											<a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
												<i class="icon-options"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="create-studyhub-form.php">Create StudyHub</a>
											</div>
										</div>
									</div> -->

								</div>
					
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>No.</th>
												<th>Club Name</th>
												<th>Position</th>
                                                <th>Skill Needed</th>
												<th>Action</th>
											</tr>
										</thead>
										
										<tbody>
											<?php
												include("assets/php/connection.php");

												$user_ID = $_SESSION['user_ID'];

												$query = "SELECT * FROM `club-application` WHERE user_ID != '$user_ID';";

                                                //$query = "SELECT * FROM `group-application`;"; 

                                                        
												$result = mysqli_query($connection, $query);


												$count = 1; // Initialize count variable

												// Check if there are no mentees or no rows found
												if (mysqli_num_rows($result) == 0) {
													echo '<tr><td colspan="4">No application found.</td></tr>';
												} 
												
												else {


													while ($row = mysqli_fetch_assoc($result)) {

														//$query2 = "SELECT * FROM `group-application` WHERE user_ID != '$user_ID';";
														
                                                            echo '
                                                                <tr>
                                                                    <th scope="row">' . $count . '</th>
                                                                    <td>' . $row['club_name'] . '</td>
                                                                    <td>' . $row['position_available'] . '</td>
                                                                    <td>' . $row['skill_needed'] . '</td>
																	
                                                                    <td>
																		<a href="club_application_view.php?application_ID=' . $row['application_id'] . '" class="btn btn-primary">View</a>
                                                                        <a href="assets/php/process_applyClubApplication.php?application_ID=' . $row['application_id'] . '" class="btn btn-success">Apply</a>
                                                                    </td>
                                                                </tr>
                                                            ';

															$count++;
                                                        // }
                                                        
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

						<!--End Row-->

						

						<!--End Dashboard Content-->
						<div class="overlay toggle-menu"></div>
					</div>

					

				</div>
				<!--End content-wrapper-->
		
			<script src="assets/js/notification.js"></script>
    
			<script>
				displayNotifications();
			</script>									
			<!--Start Back To Top Button-->
			<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
			<!--End Back To Top Button-->
			
			<!--Start footer-->
			<footer class="footer">
				<div class="container">
					<div class="text-center">
					</div>
				</div>
			</footer>
			<!--End footer-->
		
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
		</div><!--End wrapper-->

		<!-- Bootstrap core JavaScript-->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- simplebar js -->
		<script src="assets/plugins/simplebar/js/simplebar.js"></script>
		<!-- sidebar-menu js -->
		<script src="assets/js/sidebar-menu.js"></script>
		<!-- loader scripts -->
		<script src="assets/js/jquery.loading-indicator.js"></script>
		<!-- Custom scripts -->
		<script src="assets/js/app-script.js"></script>
		<!-- Chart js -->
	  
		<script src="assets/plugins/Chart.js/Chart.min.js"></script>
	 
		<!-- Index js -->
		<script src="assets/js/index.js"></script>
		<script src="assets/js/inviteMM.js"></script>
	</body>
</html>
