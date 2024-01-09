<?php
	session_start();
	// Check if the session variable exists
	if (!isset($_SESSION['user_ID'])) {
		// Redirect to the login page
		header("Location: login.php");
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
		<title>Mentorship</title>
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
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<style>
			.badge-container {
				display: flex;
				flex-wrap: wrap;
				gap: 5px;
			}

			.badge-wrapper {
				display: inline-block;
			}

			.delete-button {
				color: #ff0000;
				font-weight: bold;
				font-size: 18px; /* Adjust the font size to make the X button bigger */
				margin-left: 5px; /* Add some spacing between the input field and the X button */
				padding: 4px 8px; 
				text-decoration: none;
				margin-left: 5px; /* Add some spacing between the input field and the X button */
				margin-right: -10px; /* Move the X button towards the right edge of the badge */
			}
			.badge-pill {
				display: flex;
				align-items: center;
			}
			.badge-input {
				width: 60%; /* Adjust the width as per your preference */
				display: inline-block;
				vertical-align: middle;
			}

			.badge-name {
				margin-right: 5px; /* Add some spacing between the badge name and input field */
			}
			
			.star-rating {
				font-size: 24px;
			}
			
			.fa-star {
				color: gray;
			}
			
			.checked {
				color: gold;
			}


			body {
				transition: filter 0.3s ease-in-out;
			}

			.container {
				display: none;
				position: fixed;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				background-color: white;
				padding: 20px;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
				z-index: 9999;
				width: 50%;
			}

			.container.active {
			display: block;
			}

			.close-btn {
				position: absolute;
				bottom: 10px;
				right: 10px;
				cursor: pointer;
			}
			.img-circle {
				border-radius: 50%;
				object-fit: cover; /* Maintain image aspect ratio */
				/* Add any additional styles or adjustments as needed */
			}

		</style>
		
	</head>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<body class="bg-theme bg-theme9">
		<!-- start loader -->
		<div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
		<!-- end loader -->

		<!-- Start wrapper-->
		<div id="wrapper">
			<?php include_once('sidebar.php'); ?>
			<?php include_once('topbar.php'); ?>
			
			<div class="clearfix"></div>
		
			<div class="content-wrapper">
				<div class="container-fluid">
					<!--SWITCH BUTTONS -->
					<div>
						<center>
							<?php
								if($_SESSION["mentorshipStatus"] == "Mentor"){
									?>
									<button onclick = "showMTprofile()"class="btn btn-secondary">My Mentorship Profile</button>
							
									<?php
								}

								else{
									?>
									<button onclick = "showMYApplication()" class="btn btn-secondary">Applications</button>
									<?php
									
								}
							?>
						
					
						</center>
					</div>	
					<br>				
					<div class="row" id = "firstContent" style="display:none;">
						<div class="col-12 col-lg-8 col-xl">
							<div class="card">
								<div class="card-body">
									<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
										<li class="nav-item">
											<a href="javascript:void();" data-target="#mentorshipProfile" data-toggle="pill" class="nav-link active"><i class="zmdi zmdi-account-box-mail"></i> <span class="hidden-xs">Mentor</span></a>
										</li>
									</ul>
									
									
									<div class="tab-content p-3">
										<div class="tab-pane active" id="mentorshipProfile">
											<div class="row">
												<div class="col-lg-4">
													<div class="card">
													  <div class="card-body" >
														<div class="card-title">My Information</div>
														 <hr>
														<div class="row">
															<div class="col-lg-6">
																<img class="profile" src="assets/php/image.php?picture=profile&user_ID=<?php echo $_SESSION["user_ID"];?>" alt="profile-image">
															</div>
															<div class="col-lg-6">
																<h6>Name</h6>
																	<p>
																	<?php echo $_SESSION["name"];?>
																</p>
																<hr>
																<h6>Email</h6>
																<p>
																	<?php echo $_SESSION["email"];?>
																</p>
															</div>
														 
														</div>
														<div class="row">
															
															<div class="col-lg-12">
																<hr>
																<h6>Subject Interest</h6>
																<div class='badge-wrapper'>
																	<a class='badge badge-dark badge-pill'>html5</a>
																</div>
																<div class='badge-wrapper'>
																	<a class='badge badge-dark badge-pill'>codeply</a>
																</div>
																<div class='badge-wrapper'>
																	<a class='badge badge-dark badge-pill'>angularjs</a>
																</div>
																<div class='badge-wrapper'>
																	<a class='badge badge-dark badge-pill'>responsive-design</a>
																</div>
																<div class='badge-wrapper'>
																	<a class='badge badge-dark badge-pill'>html5</a>
																</div>
																<div class='badge-wrapper'>
																	<a class='badge badge-dark badge-pill'>html5</a>
																</div>
															</div>
														
														</div>
														
													  </div>
													</div>
													</div>

													<div class="col-lg-8">
													<div class="card" style ="min-height: 320px;">
														<div class="card-body">
															<div class="card-title">My Mentees</div>
															<div class="table-responsive">
																<table class="table table-hover">
																	<thead>
																		<tr>
																			<th scope="col">#</th>
																			<th scope="col">Mentee</th>
																			<th scope="col">Date Joined</th>
																			<th scope="col">Action</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php
																			include("assets/php/connection.php");

																			$query = "SELECT * FROM mentorship WHERE mentor_ID = '{$_SESSION['user_ID']}' and status = 'Approved'";
																			$result = mysqli_query($connection, $query);

																			$count = 1; // Initialize count variable

																			// Check if there are no mentees or no rows found
																			if (mysqli_num_rows($result) == 0) {
																				echo '<tr><td colspan="4">No mentees found.</td></tr>';
																			} else {
																				while ($row = mysqli_fetch_assoc($result)) {
																					$mentee_ID = $row['mentee_ID'];
																					$query_2 = "SELECT * FROM user WHERE user_ID = '{$mentee_ID}'";
																					$result_2 = mysqli_query($connection, $query_2);
																					$row_2 = mysqli_fetch_assoc($result_2);

																					// Output each row of the table
																					echo '
																						<tr>
																							<th scope="row">' . $count . '</th>
																							<td>' . $row_2['name'] . '</td>
																							<td>' . $row['dateCreated'] . '</td>
																							<td>
																								<a href="myProfile.php?user_ID=' . $row_2['user_ID'] . '" class="btn btn-info">View</a>
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
												</div>
												
												
											</div>
											<div class="row">
												<div class="col-lg-12">
													<div class="card">
															<div class="card-body">
																<div class="card-title">Pending Applications</div>
																<div class="table-responsive">
																	<table class="table table-hover">
																		<thead>
																			<tr>
																				<th scope="col">#</th>
																				<th scope="col">Applicant</th>
																				<th scope="col" style="text-align: center;">Application Date</th>
																				<th scope="col" style="text-align: center;">Rating</th>
																				<th scope="col" colspan="2" style="text-align: center;">Action</th>
																			</tr>
																		</thead>
																		<tbody>
																		<?php
																		include("assets/php/connection.php");

																		$query = "SELECT * FROM mentorship WHERE mentor_ID = '{$_SESSION['user_ID']}' and status = 'Pending'";
																		$result = mysqli_query($connection, $query);

																		$count = 1; // Initialize count variable

																		// Check if there are no pending applications
																		if (mysqli_num_rows($result) == 0) {
																			echo '<tr><td colspan="5">No pending applications found.</td></tr>';
																		} else {
																			while ($row = mysqli_fetch_assoc($result)) {
																				$mentee_ID = $row['mentee_ID'];
																				$query_2 = "SELECT * FROM user WHERE user_ID = '{$mentee_ID}'";
																				$result_2 = mysqli_query($connection, $query_2);
																				$row_2 = mysqli_fetch_assoc($result_2);

																				// Output each row of the table
																				echo '
																					<tr>
																						<th scope="row">' . $count . '</th>
																						<td><a href="myProfile.php?user_ID=' . $row_2['user_ID'] . '">' . $row_2['name'] . '</a></td>

																						<td style="text-align: center;">' . $row['dateCreated'] . '</td>
																						<td style="text-align: center;">' . $row_2['rating'] . '</td>
																						<td style="text-align: center;">
																							<a href="" class="btn btn-success" onclick="approval(' . $row['mt_ID'] . ', \'Approved\')">Approve</a>
																							<a href="" class="btn btn-danger" onclick="approval(' . $row['mt_ID'] . ', \'Rejected\')">Reject</a>

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
													
												</div>												
											</div>
											
										</div>
										
										
										
									</div>
									
									
									
									
									
								</div>
							</div>
						</div>
						
					
					</div>

																	
					

															
					<div class="row" id = "secondContent" style="display:none;">
						<div class="col-12 col-lg-8 col-xl">
							<div class="card">
								<div class="card-body">
									<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
										<li class="nav-item">
											<a href="javascript:void();" data-target="#mentorList" data-toggle="pill" class="nav-link active"><i class="zmdi zmdi-account-box-mail"></i> <span class="hidden-xs">Mentor List</span></a>
										</li>
										<li class="nav-item">
											<a href="javascript:void();" data-target="#myApplication" data-toggle="pill" class="nav-link"><i class="zmdi zmdi-assignment-o"></i> <span class="hidden-xs">My Applications</span></a>
										</li>
									</ul>
									
	
									<div class="tab-content p-3">
										<div class="tab-pane" id="myApplication">
											<div class="row">
												<div class="col-lg-12">
													<div class="card">
														<div class="card-body">
															<div class="card-title">My Applications</div>
															<div class="table-responsive">
																<table class="table table-hover">
																<thead>
																	<tr>
																		<th scope="col">#</th>
																		<th scope="col">Mentor</th>
																		<th scope="col">Application Date</th>
																		<th scope="col">Status</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	include("assets/php/connection.php");

																	$query = "SELECT * FROM mentorship WHERE mentee_ID = '{$_SESSION['user_ID']}'";
																	$result = mysqli_query($connection, $query);

																	$count = 1; // Initialize count variable

																	while ($row = mysqli_fetch_assoc($result)) {
																		$mentor_ID = $row['mentor_ID'];
																		$query_2 = "SELECT * FROM user WHERE user_ID = '{$mentor_ID}'";
																		$result_2 = mysqli_query($connection, $query_2);
																		$row_2 = mysqli_fetch_assoc($result_2);
																		
																		// Output each row of the table
																		echo '
																			<tr>
																				<th scope="row">' . $count . '</th>
																				<td>' . $row_2['name'] . '</td>
																				<td>' . $row['dateCreated'] . '</td>
																				<td>';

																			if ($row['status'] === 'Approved') {
																				echo '<span class="badge badge-success"><i class="fa fa-cog"></i> ' . $row['status'] . '</span>';
																			} else if ($row['status'] === 'Pending')  {
																				echo '<span class="badge badge-warning"><i class="fa fa-cog"></i> ' . $row['status'] . '</span>';
																			}
																			else {
																				echo '<span class="badge badge-danger"><i class="fa fa-cog"></i> ' . $row['status'] . '</span>';
																			}

																			echo '
																				</td>
																			</tr>
																			';

																		$count++; // Increment count for each row
																	}

																	// Close the database connection
																	mysqli_close($connection);
																	?>


																</tbody>
																	
																</table>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!--- LIST OF MENTOR -->
										<div class="tab-pane active" id="mentorList">
											<div class="row">
											<div class="col-lg-12">
												<div class="card">
													<div class="card-body">
														<h5 class="card-title">List of Mentors</h5>
														<div class="table-responsive " >
														<?php
														include("assets/php/connection.php");

														$query = "SELECT u.user_ID, u.name, COUNT(CASE WHEN m.status = 'Approved' THEN m.Mentee_ID END) AS numberOfMentees,
																   (SELECT AVG(r.stars) FROM review r
																	INNER JOIN feedback f ON r.review_ID = f.review_ID
																	WHERE f.reviewee = u.user_ID) AS rating
															FROM user u
															LEFT JOIN Mentorship m ON u.user_ID = m.Mentor_ID
															WHERE u.mentorshipStatus = 'Mentor'
															GROUP BY u.user_ID, u.name;
															";
														$result = mysqli_query($connection, $query);

														$count = 1; // Initialize count variable

														if (mysqli_num_rows($result) > 0) {
															// Output the table structure
															echo '
															<table class="table table-hover">
																<thead>
																	<tr>
																		<th scope="col">#</th>
																		<th scope="col">Name</th>
																		<th scope="col">Number of Mentees</th>
																		<th scope="col">Rating</th>
																		<th scope="col">Action</th>
																	</tr>
																</thead>
																<tbody>
															';

															// Output each row of the table
															while ($row = mysqli_fetch_assoc($result)) {
															?>
																<tr>
																	<th scope="row"><?php echo $count; ?></th>
																	<td><?php echo $row['name']; ?></td>
																	<td><?php echo $row['numberOfMentees']; ?></td>
																	<td><?php echo round($row['rating'], 2); ?></td>
																	<td>
																		<a href="myProfile.php?user_ID=<?php echo $row['user_ID']; ?>" class="btn btn-info">View</a>
																		<?php 
																			$checkQuery = "SELECT * FROM mentorship WHERE mentor_ID = '{$row['user_ID']}' AND mentee_ID = '{$_SESSION['user_ID']}'";
																			$resulty = mysqli_query($connection, $checkQuery);

																			if ($resulty) {
																				// Check if a row exists in the result set
																				if (mysqli_num_rows($resulty)> 0) {
																				}
																				else if (mysqli_num_rows($resulty)== 0){
																					
																					echo '<a class="btn btn-success" onclick="apply(' . $row['user_ID'] . ')">Apply</a>';
																				}
																					
																			}
																		?>
																		
																		

																	</td>
																</tr>
															<?php
																$count++; // Increment count for each row
															}

															// Close the table structure
															echo '
																</tbody>
															</table>
															';
														} else {
															echo "No mentors found.";
														}

														// Close the database connection
														mysqli_close($connection);
														?>






														</div>
													</div>
												</div>
												</div>
											</div>
										</div>
										
									</div>

								</div>
							</div>
						</div>
					</div>	
					
				

					<div class="row" id = "thirdContent" style="display:block;">
						<div class="col-12 col-lg-8 col-xl">
							<div class="card">
								<div class="card-body">
									<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
										<li class="nav-item">
											<a href="javascript:void();" data-target="#mentorshipProfile" data-toggle="pill" class="nav-link active"><i class="zmdi zmdi-account-box-mail"></i> <span class="hidden-xs">Mentee</span></a>
										</li>
									</ul>
									
									
									<div class="tab-content p-3">
										<div class="tab-pane active" id="mentorshipProfile">
											<div class="row">
												<div class="col-lg-4">
													<div class="card">
													  	<div class="card-body">
															<div class="card-title">My Information</div>
														 	<hr>
															<div class="row">
																<div class="col-lg-6">
																	<img class="profile" src="assets/php/image.php?picture=profile&user_ID=<?php echo $_SESSION["user_ID"];?>" alt="profile-image">
																</div>
																<div class="col-lg-6">
																	<h6>Name</h6>
																		<p>
																		<?php echo $_SESSION["name"];?>
																	</p>
																	<hr>
																	<h6>Email</h6>
																	<p>
																		<?php echo $_SESSION["email"];?>
																	</p>
																</div>
															
															</div>
															<div class="row">
																<div class="col-lg-12">
																	<hr>
																	<h6>Subject Interest</h6>
																	<div class='badge-wrapper'>
																		<a class='badge badge-dark badge-pill'>html5</a>
																	</div>
																	<div class='badge-wrapper'>
																		<a class='badge badge-dark badge-pill'>codeply</a>
																	</div>
																	<div class='badge-wrapper'>
																		<a class='badge badge-dark badge-pill'>angularjs</a>
																	</div>
																	<div class='badge-wrapper'>
																		<a class='badge badge-dark badge-pill'>responsive-design</a>
																	</div>
																	<div class='badge-wrapper'>
																		<a class='badge badge-dark badge-pill'>html5</a>
																	</div>
																	<div class='badge-wrapper'>
																		<a class='badge badge-dark badge-pill'>html5</a>
																	</div>

																	</div>
																	</div>
														
													 			 </div>
															</div>
															</div>
																<div class="col-lg-8">
																	<div class="card" style ="min-height: 320px;">
																		<div class="card-body">
																			<div class="card-title">My Mentees</div>
																			<div class="table-responsive">
																				<table class="table table-hover">
																					<thead>
																						<tr>
																							<th scope="col">#</th>
																							<th scope="col">Mentee</th>
																							<th scope="col">Date Joined</th>
																							<th scope="col">Action</th>
																						</tr>
																					</thead>
																					<tbody>
																						<?php
																							include("assets/php/connection.php");

																							$query = "SELECT * FROM mentorship WHERE mentor_ID = '{$_SESSION['user_ID']}' and status = 'Approved'";
																							$result = mysqli_query($connection, $query);

																							$count = 1; // Initialize count variable

																							// Check if there are no mentees or no rows found
																							if (mysqli_num_rows($result) == 0) {
																								echo '<tr><td colspan="4">No mentees found.</td></tr>';
																							} else {
																								while ($row = mysqli_fetch_assoc($result)) {
																									$mentee_ID = $row['mentee_ID'];
																									$query_2 = "SELECT * FROM user WHERE user_ID = '{$mentee_ID}'";
																									$result_2 = mysqli_query($connection, $query_2);
																									$row_2 = mysqli_fetch_assoc($result_2);

																									// Output each row of the table
																									echo '
																										<tr>
																											<th scope="row">' . $count . '</th>
																											<td>' . $row_2['name'] . '</td>
																											<td>' . $row['dateCreated'] . '</td>
																											<td>
																												<a href="myProfile.php?user_ID=' . $row_2['user_ID'] . '" class="btn btn-info">View</a>
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
																</div>
												
												
											</div>
											<div class="row">
												<div class="col-lg-12">
													<div class="card">
															<div class="card-body">
																<div class="card-title">Pending Applications</div>
																<div class="table-responsive">
																	<table class="table table-hover">
																		<thead>
																			<tr>
																				<th scope="col">#</th>
																				<th scope="col">Applicant</th>
																				<th scope="col" style="text-align: center;">Application Date</th>
																				<th scope="col" style="text-align: center;">Rating</th>
																				<th scope="col" colspan="2" style="text-align: center;">Action</th>
																			</tr>
																		</thead>
																		<tbody>
																		<?php
																		include("assets/php/connection.php");

																		$query = "SELECT * FROM mentorship WHERE mentor_ID = '{$_SESSION['user_ID']}' and status = 'Pending'";
																		$result = mysqli_query($connection, $query);

																		$count = 1; // Initialize count variable

																		// Check if there are no pending applications
																		if (mysqli_num_rows($result) == 0) {
																			echo '<tr><td colspan="5">No pending applications found.</td></tr>';
																		} else {
																			while ($row = mysqli_fetch_assoc($result)) {
																				$mentee_ID = $row['mentee_ID'];
																				$query_2 = "SELECT * FROM user WHERE user_ID = '{$mentee_ID}'";
																				$result_2 = mysqli_query($connection, $query_2);
																				$row_2 = mysqli_fetch_assoc($result_2);

																				// Output each row of the table
																				echo '
																					<tr>
																						<th scope="row">' . $count . '</th>
																						<td><a href="myProfile.php?user_ID=' . $row_2['user_ID'] . '">' . $row_2['name'] . '</a></td>

																						<td style="text-align: center;">' . $row['dateCreated'] . '</td>
																						<td style="text-align: center;">' . $row_2['rating'] . '</td>
																						<td style="text-align: center;">
																							<a href="" class="btn btn-success" onclick="approval(' . $row['mt_ID'] . ', \'Approved\')">Approve</a>
																							<a href="" class="btn btn-danger" onclick="approval(' . $row['mt_ID'] . ', \'Rejected\')">Reject</a>

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
													
												</div>												
											</div>
											
										</div>
										
										
										
									</div>
									
									
									
									
									
								</div>
							</div>
						</div>
						
					
					</div>
				</div>
				<!--Start Back To Top Button-->
				<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
				<!--End Back To Top Button-->
				
				<script>
					
							
				
				function showMTprofile(){
					var sessionStatus = "<?php echo $_SESSION['mentorshipStatus']; ?>"; // Replace with your actual session status variable
					var firstContentDiv = document.getElementById("firstContent");
					var secondContentDiv = document.getElementById("secondContent");
					
					firstContentDiv.style.display = "block";
					secondContentDiv.style.display = "none";
				}

				function showMYApplication(){
					var sessionStatus = "<?php echo $_SESSION['mentorshipStatus']; ?>"; // Replace with your actual session status variable
					var firstContentDiv = document.getElementById("firstContent");
					var secondContentDiv = document.getElementById("secondContent");
					
					firstContentDiv.style.display = "none";
					secondContentDiv.style.display = "block";
				}
				
				function approval(mt_ID, answer) {
					var answerText = answer.toLowerCase();
					if (answerText === "rejected") {
						answerText = answerText.slice(0, -2);
					} else {
						answerText = answerText.slice(0, -1);
					}
					if (confirm("Are you sure you want to " + answerText  +" this application?")) {
						$.ajax({
							url: 'assets/php/process_applicationApproval.php',
							method: 'POST',
							data: { mt_ID: mt_ID, status: answer },
							success: function(response) {
								// Handle the response from the PHP script
								console.log(response);
								if (answer == "Rejected")
									alert("Application has been rejected!");
								else
									alert("Application has been approved!");
							},
							error: function(xhr, status, error) {
								// Handle the error
								console.log(error);
							}
						});
					}
				}
				
				
				
				function apply(mentor_ID) {
					if (confirm("Are you sure you want to apply?")) {
						$.ajax({
							url: 'assets/php/process_applyToBeMentee.php',
							method: 'POST',
							data: { mentor_ID: mentor_ID },
							success: function(response) {
								// Handle the response from the PHP script
								console.log(response);
								alert("Application has been sent!");

								// Reload the page
								location.reload();
							},
							error: function(xhr, status, error) {
								// Handle the error
								console.log(error);
							}
						});
					}
				}

				</script>

				
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
    
			<script>
				displayNotifications();
			</script>					
			
	</body>
</html>

<?php 
	}
	
?>