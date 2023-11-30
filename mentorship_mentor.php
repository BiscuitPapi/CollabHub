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
		<link rel="stylesheet" href="assets/css/modally.css">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
			<!--Start Content Wrapper-->
			<div class="content-wrapper">
				<div class="container-fluid">
				<span class="badge badge-primary" style="font-size: 15px;"><i class="fa fa-user"></i>  Mentor</span>
			

					<div class="row mt-3">
						

						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">
									<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
										<li class="nav-item">
											<a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active"><i class="zmdi zmdi-account-box-mail"></i> <span class="hidden-xs">My Mentorship Profile</span></a>
										</li>
										<li class="nav-item">
											<a href="javascript:void();" data-target="#pendingApplication" data-toggle="pill" class="nav-link"><i class="zmdi zmdi-assignment-o"></i> <span class="hidden-xs">Pending Applications</span></a>
										</li>
									</ul>
									
									
									<div class="tab-content p-3">
										<!-- START OF MY MENTORSHIP PROFILE -->
										<div class="tab-pane active" id="profile">
											<div class="row">
												<!-- FIRST COLUMN -->
												<div class="col-lg-4">
													<div class="card">
														<div class="card-body">
															<div class="card-title">My Information</div>
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
																	<div class="d-flex justify-content-between align-items-center">
																		<h6 class="mb-0">Subject Interest</h6>
																		<span class="d-flex">
																			<span class="badge badge-success clickable-add mr-2" style="cursor: pointer;"><i></i> + Add</span>
																			<span class="badge badge-danger clickable-delete" style="cursor: pointer;"><i></i> - Delete</span>
																		</span>
																	</div>
																	

																	<br>
																	<div class="badge-wrapper d-flex flex-wrap" id="badge-container"></div>
																	<div id="no-subjects-found" style="display: none;">
																		No subjects found for this user.
																	</div>
																	<?php 
																		include("assets/php/connection.php");
																		
																		if (isset($_SESSION["user_ID"])) {
																			// Assuming you have already established a database connection
																			
																			// Retrieve subjects for the logged-in user
																			$user_ID = $_SESSION["user_ID"];
																			$stmt = $connection->prepare("SELECT subjects FROM user WHERE user_ID = ?");
																			$stmt->bind_param("i", $user_ID);
																			$stmt->execute();
																			$stmt->bind_result($currentSubjects);
																			$stmt->fetch();
																			$stmt->close();
																			
																			// Check if subjects were retrieved and display them
																			if (!empty($currentSubjects)) {
																				$subjectsArray = explode("###", $currentSubjects);
																				
																				echo '<div class="badge-wrapper d-flex flex-wrap" id="badge-container">'; // Use d-flex to arrange the badges horizontally
																				
																				$count = 0;
																				foreach ($subjectsArray as $subject) {
																					$subject = trim($subject); // Remove any leading/trailing spaces
																					if (!empty($subject)) {
																						if ($count % 4 == 0 && $count > 0) {
																							echo '</div>'; // Close the previous row
																							echo '<div class="badge-wrapper d-flex flex-wrap" style="margin-top: 10px;">'; // Open a new row
																						}
																						echo "<a class='badge badge-dark badge-pill mr-2'>$subject</a>";
																						$count++;
																					}
																				}
																				
																				// Close the last badge-wrapper
																				echo '</div>';
																			}

																			

																		
																		} else {
																			echo "User is not logged in.";
																		}
																	?>
																</div>
															</div>
															<!-- ADD SUBJECT -->
															<div id="modal" class="modal">
																<div class="modal-content">
																	<span class="close">&times;</span>
																	<!-- Content for your modal goes here -->
																	<center><h3>Add Subject</h3></center>
																	
																	<!-- Your additional content for adding badges -->
																	<div class="tab-pane" id="addSubject">
																		<div class="row">
																			<div class="col-md-12">
																				<h5 class="mb-3"></h5>
																				<div class="form-group">
																					<label for="input-1">Subject Name</label>
																					<input type="text" class="form-control" name="addedSubject" id="addedSubject" placeholder="" required>
																				</div>
																			
																				<br>
																				<center><button onclick="addNewBadge()" class="btn btn-success">Add Subject</button></center>
																			</div>	
																		</div>
																	</div>
																</div>
															</div>
															<!-- END OF ADD SUBJECT -->

															<!-- DELETE SUBJECT -->
															<div id="delete-modal" class="modal">
																<div class="modal-content">
																	<span class="close">&times;</span>
																	<!-- Content for your modal goes here -->
																	<center><h3>Delete Subject</h3></center>
																	<br>
																	<!-- Your additional content for adding badges -->
																	<div class="tab-pane" id="deleteSubject">
																		<div class="row">
																			<div class="col-md-12">
																				<div class="media align-items-center">
																				
																					<div class="progress-wrapper">
																						<?php
																					
																							include("assets/php/connection.php");
																							$user_ID = $_SESSION["user_ID"];
																							$stmt = $connection->prepare("SELECT subjects FROM user WHERE user_ID = ?");
																							$stmt->bind_param("i", $user_ID);
																							$stmt->execute();
																							$stmt->bind_result($currentSubjects);
																							$stmt->fetch();
																							$stmt->close();
																							
																							if (!empty($currentSubjects)) {
																								$subjectsArray = explode("###", $currentSubjects);
																							
																								echo '<div class="badge-wrapper d-flex flex-wrap justify-content-center">'; // Center the subjects and allow them to wrap
																							
																								$count = 0;
																								foreach ($subjectsArray as $subject) {
																									$subject = trim($subject); // Remove any leading/trailing spaces
																									if (!empty($subject)) {
																										if ($count % 2 == 0 && $count > 0) {
																											echo '<div class="w-100" style="margin-top: 10px;"></div>'; // Create a new row
																										}
																							
																										echo "<div class='d-flex align-items-center'>";
																										echo "<input type='text' class='form-control badge-input' style='width: 50%' value='" . $subject . "' readonly>";
																							
																										// Add the data attribute to store the subject's value
																										echo "<button class='delete-button' data-subject='" . $subject . "' onclick='deleteBadge(this)'>✖</button>";
																							
																										echo "</div>";
																							
																										$count++;
																									}
																								}
																							
																								echo '</div>';
																								echo "<br><br>";
																								echo "<center><button class='btn btn-primary' onclick='saveChanges()'>Save Changes</button></center>";

																							} else {
																								echo "No subjects found for this user.";
																							}
																							
																							
																						?>	
																					</div>
																				</div>
																			</div>	
																		</div>
																	</div>
																</div>
															</div>
															<!-- END OF DELETE SUBJECT -->

														</div> 
													</div>	
												</div>	
												
												
												
												<!-- SECOND COLUMN -->
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
																			}
																			else {
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
																								<a href="myProfile.php?user_ID=' . $row_2['user_ID'] . '" class="btn btn-success">View</a>
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
											</div> <!-- ROW ENDS HERE -->
										</div>
										<!-- END OF MY MENTORSHIP PROFILE -->


										<!-- START OF MY PENDING APPLICATIONS  -->
										<div class="tab-pane" id="pendingApplication">
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
											</div> <!-- ROW ENDS HERE -->
											
										</div>	
										<!-- END OF MY PENDING APPLICATIONS  -->	
									</div>
								</div>
							</div>
						</div>
			
					</div>

					<!--start overlay-->
					<div class="overlay toggle-menu"></div>
					<!--end overlay-->
				</div>
				<!-- End container-fluid-->
			</div>
			<!--End content-wrapper-->
			
			<script>
				function approval(mt_ID, answer) {
					var answerText = answer.toLowerCase();
					if (answerText === "rejected") {
						answerText = answerText.slice(0, -2);
					} else {
						answerText = answerText.slice(0, -1);
					}
					if (confirm("Are you sure you want to " + answerText + " this application?")) {
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

				// Get the "Add" span element
				var addSpan = document.querySelector(".clickable-add");

				// Get the "Delete" span element
				var deleteSpan = document.querySelector(".clickable-delete");

				// Get the add modal, close button, and modal content
				var addModal = document.getElementById("modal");
				var addModalCloseButton = addModal.querySelector(".close");
				var addModalContent = addModal.querySelector(".modal-content");

				// Get the delete modal, close button, and modal content
				var deleteModal = document.getElementById("delete-modal");
				var deleteModalCloseButton = deleteModal.querySelector(".close");
				var deleteModalContent = deleteModal.querySelector(".modal-content");

				// Function to display the add modal
				function showAddModal() {
					addModal.style.display = "block";
				}

				// Function to close the add modal
				function closeAddModal() {
					addModal.style.display = "none";
				}

				// Function to display the delete modal
				function showDeleteModal() {
					deleteModal.style.display = "block";
				}

				// Function to close the delete modal
				function closeDeleteModal() {
					deleteModal.style.display = "none";
				}

				// Open the add modal when the "Add" span is clicked
				addSpan.addEventListener("click", showAddModal);

				// Close the add modal when the close button is clicked
				addModalCloseButton.addEventListener("click", closeAddModal);

				// Close the add modal if the background is clicked
				window.addEventListener("click", function(event) {
					if (event.target === addModal) {
						closeAddModal();
					}
				});

				// Prevent clicks inside the add modal content from closing the modal
				addModalContent.addEventListener("click", function(event) {
					event.stopPropagation();
				});

				// Open the delete modal when the "Delete" span is clicked
				deleteSpan.addEventListener("click", showDeleteModal);

				// Close the delete modal when the close button is clicked
				deleteModalCloseButton.addEventListener("click", closeDeleteModal);

				// Close the delete modal if the background is clicked
				window.addEventListener("click", function(event) {
					if (event.target === deleteModal) {
						closeDeleteModal();
					}
				});

				// Prevent clicks inside the delete modal content from closing the modal
				deleteModalContent.addEventListener("click", function(event) {
					event.stopPropagation();
				});
								
				function addNewBadge() {
					var addedNameInput = document.getElementById("addedSubject");
					var addedName = addedNameInput.value;

					// Check if the input name is empty
					if (addedName.trim() === "") {
						alert("Please enter a name for the badge.");
						return; // Stop further execution
					}

					$.ajax({
						url: 'assets/php/cubaan.php',
						method: 'POST',
						data: { addedName: addedName },
						success: function (response) {
							// Handle the response from the PHP script
							console.log(response);

							// If the response indicates success, hide the "no-subjects-found" sentence
							if (response === "success") {
								var noSubjectsFound = document.getElementById("no-subjects-found");
								if (noSubjectsFound) {
									noSubjectsFound.style.display = "none";
								}

								// Create a new badge element
								var newBadge = document.createElement("a");
								newBadge.className = "badge badge-dark badge-pill mr-2";
								newBadge.innerText = addedName; // Set the badge text to the added name

								// Append the new badge to the "badge-container" div
								var badgeContainer = document.getElementById("badge-container");
								badgeContainer.appendChild(newBadge);

								// Count the number of badges currently in the container
								var badgeCount = badgeContainer.querySelectorAll(".badge").length;

								// If the badge count is a multiple of 4, open a new row
								if (badgeCount % 4 === 0) {
									// Create a new div to open a new row
									var newBadgeRow = document.createElement("div");
									newBadgeRow.className = "badge-wrapper d-flex flex-wrap";
									badgeContainer.appendChild(newBadgeRow);
								}

								alert("A new subject has been added!");
								closeAddModal();
							}
						},
						error: function (xhr, status, error) {
							// Handle the error
							console.log(error);
						}
					});
				}

				function deleteBadge(button) {

					const subject = button.getAttribute('data-subject');

					// Remove the entire parent container (the badge and the input field)
					button.parentNode.remove();

					// You can perform additional actions, such as deleting the subject from your data

					
				}

				function saveChanges() {
					const badgeInputs = document.querySelectorAll('.badge-input');
					const remainingValues = [];

					badgeInputs.forEach(function (input) {
						remainingValues.push(input.value);
					});

					// Create a string with "###" separator
					const remainingValuesString = remainingValues.join("###");

					// Send the remainingValuesString to your server for storage
					$.ajax({
						url: 'assets/php/process_saveSubjectChanges.php',
						method: 'POST',
						data: { remainingValues: remainingValuesString },
						success: function(response) {
							// Handle the response from the PHP script
							console.log(response);
						},
						error: function(xhr, status, error) {
							// Handle the error
							console.log(error);
						}
					});

					alert("Changes have been made!");
					// Reload the current page
					location.reload();
				}




									

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
		</script>					
		
	</body>
</html>

<?php 
	}
?>