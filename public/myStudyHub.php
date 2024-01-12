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
		<link href="../assets/css/pace.min.css" rel="stylesheet"/>
		<script src="../assets/js/pace.min.js"></script>
		<!--favicon-->
		<link rel="icon" href="../assets/images/CB-favi.ico" type="image/x-icon">
		<!-- Vector CSS -->
		<link href="../assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
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
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	</head>

	<body class="bg-theme bg-theme9">
 
		<!-- Start wrapper-->
		<div id="wrapper">
			<?php include_once('nav/sidebar.php'); ?>
			<?php include_once('nav/topbar.php'); ?>
			<div class="clearfix"></div>
		
			<div class="content-wrapper">
				<div class="container-fluid">

				<!--Start Dashboard Content-->
			  

				<!--Personal StudyHub List-->
					<div class="row">
						
						<div class="col-12 col-lg-12">
							<div class="card">


								<!--Top Table-->
								<div class="card-header">My StudyHub List
									<!--Drop down Menu Option-->
									<div class="card-action">
										<div class="dropdown">
											<a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
												<i class="icon-options"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="createStudyhub.php">Create StudyHub</a>
											</div>
										</div>
									</div>

								</div>
					
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>No.</th>
												<th>StudyHub Name</th>
												<th style="text-align: center;">Date Created</th>
												<th style="text-align: center;">Action</th>
											</tr>
										</thead>
										
										<tbody>
											<?php
												include("../assets/php/connection.php");
											
												$query = "SELECT sh.studyhub_ID, sh.studyhub_name, sh.date_created 
														FROM studyhubMember AS sm
														JOIN studyhub AS sh ON sm.studyhub_ID = sh.studyhub_ID
														WHERE sm.user_ID = '{$_SESSION['user_ID']}';";


												$result = mysqli_query($connection, $query);

												$count = 1; // Initialize count variable

												// Check if there are no mentees or no rows found
												if (mysqli_num_rows($result) == 0) {
													echo '<tr><td colspan="4">No studyhub found.</td></tr>';
												} 
												
												else {
													while ($row = mysqli_fetch_assoc($result)) {
														echo'
															<tr>
															<th scope="row">' . $count . '</th>
															<td>' . $row['studyhub_name'] . '</td>
															<td style="text-align: center;">' . $row['date_created'] . '</td>
															<td style="text-align: center;">
																<a href="SB_profile.php?studyhub_ID=' . $row['studyhub_ID'] . '" class="btn btn-info">View</a>

																
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

						<!--End Row-->

						

						<!--End Dashboard Content-->
						<div class="overlay toggle-menu"></div>
					</div>

					<div class = "row">
						<div class="col-12 col-lg-12">
							<!--<a href="studyhublist.php" class="btn btn-light px-5">Search Study Hub</a>-->
						</div>
					</div> 

				</div>
				<!--End content-wrapper-->
		
		
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
		</div><!--End wrapper-->

		<!-- Bootstrap core JavaScript-->
		<script src="../assets/js/jquery.min.js"></script>
		<script src="../assets/js/popper.min.js"></script>
		<script src="../assets/js/bootstrap.min.js"></script>
		
		<!-- simplebar js -->
		<script src="../assets/plugins/simplebar/js/simplebar.js"></script>
		<!-- sidebar-menu js -->
		<script src="../assets/js/sidebar-menu.js"></script>
		<!-- loader scripts -->
		<script src="../assets/js/jquery.loading-indicator.js"></script>
		<!-- Custom scripts -->
		<script src="../assets/js/app-script.js"></script>
		<!-- Chart js -->
	  
		<script src="../assets/plugins/Chart.js/Chart.min.js"></script>
	 
		<!-- Index js -->
		<script src="../assets/js/index.js"></script>
		<script src="../assets/js/inviteMM.js"></script>
    
		<script>
			displayNotifications();
		</script>					
		
	</body>
</html>
