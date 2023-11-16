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
		<title>Edit Profile</title>
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
	

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>

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

			<!--Start sidebar-wrapper-->
			<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
				<div class="brand-logo">
					<a href="index.html">
						<img src="assets/images/collabHub-icon.png" class="logo-icon" alt="logo icon">
						<h5 class="logo-text">CollabHub</h5>
					</a>
				</div>
				
				<ul class="sidebar-menu do-nicescrol">
					<li class="sidebar-header">MAIN NAVIGATION</li>
					<li>
						<a href="index.html">
							<i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
						</a>
					</li>


					<li>
						<a href="myApplication.php">
							<i class="zmdi zmdi-format-list-bulleted"></i> <span>Open Application</span>
						</a>
					</li>

					<li>
						<a href="myStudyHub.php">
							<i class="zmdi zmdi-grid"></i> <span>StudyHub</span>
						</a>
					</li>

					<li>
						<a href="<?php
							// Check if the status is set in the session
							if (isset($_SESSION["mentorshipStatus"])) {
								// Get the status value
								$status = $_SESSION["mentorshipStatus"];
								
								// Generate the dynamic anchor link
								$link = "mentorship_" . strtolower($status) . ".php";
								
								// Output the link
								echo $link;
							} else {
								// Fallback link if the status is not set
					
								echo "mentorship.php"; // You can change this to the default link
							}
						?>">
							<i class="zmdi zmdi-male-female"></i> <span>Mentor Mentee</span>
							<small class="badge float-right badge-light">New</small>
						</a>
					</li>
					
					<li>
						<a href="peerReview.php">
							<i class="zmdi zmdi-mood-bad"></i> <span>Peer Review</span>
							<small class="badge float-right badge-light">New</small>
						</a>
					</li>
				</ul>
			</div>
			<!--End sidebar-wrapper-->

			<!--Start topbar header-->
			<header class="topbar-nav">
				<nav class="navbar navbar-expand fixed-top">
					<ul class="navbar-nav mr-auto align-items-center">
						<li class="nav-item">
							<a class="nav-link toggle-menu" href="javascript:void();">
								<i class="icon-menu menu-icon"></i>
							</a>
						</li>
						<li class="nav-item">
							<form class="search-bar">
								<input type="text" class="form-control" placeholder="Enter keywords">
								<a href="javascript:void();"><i class="icon-magnifier"></i></a>
							</form>
						</li>
					</ul>
				 
					<ul class="navbar-nav align-items-center right-nav-link">
						<li class="nav-item dropdown-lg">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
							<i class="fa fa-envelope-open-o"></i></a>
						</li>
						<li class="nav-item language">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
								<i class="fa fa-bell-o position-relative" style="font-size: 24px;">
									<!-- No span for notification count here -->
								</i>
							</a>


							<ul id="notificationList" class="dropdown-menu dropdown-menu-right">
									
									
							</ul>
						</li>
						<li class="nav-item language">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();"><i class="fa fa-flag"></i></a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
								<li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
								<li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
								<li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
							</ul>
						</li>
						<li class="nav-item">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
								<span class="user-profile">
									<img class="img-circle" src="assets/php/image.php?picture=profile&user_ID=<?php echo $_SESSION["user_ID"];?> " alt="profile-image" id ="smallProfilePicture_1">	
								</span>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li class="dropdown-item user-details">
									<a href="myProfile.php">
										<div class="media">
											<div class="avatar"><img class="align-self-start mr-3" src="assets/php/image.php?picture=profile&user_ID=<?php echo $_SESSION["user_ID"];?> " alt="profile-image" id ="smallProfilePicture_2">	</div>
											<div class="media-body">
												<h6 class="mt-2 user-title"><?php echo $_SESSION['name'];?></h6>
												<p class="user-subtitle"><?php echo $_SESSION['email'];?></p>
											</div>
										</div>
									</a>
								</li>
							
								<li class="dropdown-divider"></li>
								<li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
								<li class="dropdown-divider"></li>
								<li class="dropdown-item"><a href="myProfile.php"><i class="icon-wallet mr-2"></i> Account</li>
								<li class="dropdown-divider"></li>
								<li class="dropdown-item"><a href="editProfile.php"><i class="icon-settings mr-2"></i> Setting</a></li>
								<a href = "assets/php/logout.php">
									<li class="dropdown-item">
										
										<i class="icon-power mr-2"></i> Logout
										
									</li>
								</a>
							</ul>
						</li>
					</ul>
				</nav>
			</header>
			<!--End topbar header-->

			<div class="clearfix"></div>
		
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<!-- New row or section -->
						<div class="col-6">
							<div class="card">
								<div class="card-body">
									<div class="tab-pane active" id="about">
										<div class="row">
											<div class="col-md-12">
												<h5 class="mb-3">Personal Information</h5>
												<div class="form-group">
													<label for="input-0">About</label>
													<textarea name="newAbout" id = "newAbout" class="form-control" rows="10"><?php echo $_SESSION['about'];?></textarea>
												</div>

												<div class="form-group">
													<label for="input-1">Position</label>
													<div class="position-relative has-icon-right">
														<input type="text" id="position" name="position" class="form-control input-shadow" value="<?php echo $_SESSION["position"];?>" required>
													</div>
												</div>
												
												<!-- Matric Number -->
												<div class="form-group">
													<label for="input-1">Matric Number</label>
													<div class="position-relative has-icon-right">
														<input type="text" id="matricNum" name="matricNum" class="form-control input-shadow" value="<?php echo $_SESSION["matricNum"];?>" required>
													</div>
												</div>
												
												<!-- Mobile Number -->
												<div class="form-group">
													<label for="input-1">Mobile Number</label>
													<div class="position-relative has-icon-right">
														<input type="text" id="mobile" name="mobile" class="form-control input-shadow" value="<?php echo $_SESSION["mobile"];?>" required>
													</div>
												</div>

										
												<br>
												<button onclick = "updateProfile()"class="btn btn-primary">Save Changes</button>
											</div>	
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-8 col-xl">
							<div class="card">
								<div class="card-body">
									<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
										<li class="nav-item">
											<a href="javascript:void();" data-target="#editBadge" data-toggle="pill" class="nav-link active"><i class="zmdi zmdi-brush"></i> <span class="hidden-xs">Edit Badge</span></a>
										</li>
										
										<li class="nav-item">
											<a href="javascript:void();" data-target="#addBadge" data-toggle="pill" class="nav-link"><i class="zmdi zmdi-case-check"></i> <span class="hidden-xs">Add Badge</span></a>
										</li>
									</ul>
									

									
									<div class="tab-content p-3">
										<!--- EDIT BADGES -->
										<div class="tab-pane active" id="editBadge">
											<div class="row" style="overflow-y: scroll; max-height: 600px;">
												<div class="card-body border-top border-light">
													
											<?php
												include("assets/php/connection.php");

												$badgeTypes = array(
													'Technical Skills' => 'Technical Skills',
													'Soft Skills' => 'Soft Skills',
													'Others' => 'Others'
												);

												echo "<div class='media align-items-center'>";
												echo "<div class='progress-wrapper'>";
												
												foreach ($badgeTypes as $key => $type) {
													$sql = "SELECT * FROM badge WHERE type = '$type' AND user_ID = '{$_SESSION['user_ID']}'";

													$result = mysqli_query($connection, $sql);
													
													echo "<h6>$key</h6>";

													if (mysqli_num_rows($result) > 0) {
														echo "<div class='badge-container'>";
														while ($row = mysqli_fetch_assoc($result)) {
															echo "<div class='badge-wrapper'>";
														  
															echo "<input type='text' class='form-control badge-input' style='width: 80%' id='badge_" . $row['badge_ID'] . "' value='" . $row['name'] . "'>";
															echo "<a href='' class='delete-button' onclick='deleteBadge(" . $row['badge_ID'] . ")'>&times;</a>";
															echo "</div>";
														}
														echo "</div>";
													} else {
														echo "No $key badges found.";
													}

													echo "<br><hr>";
												}

												echo "<button class='btn btn-primary' onclick='saveChanges()'>Save Changes</button>";
												echo "</div>";
												echo "</div>";
											?>


													
												</div>
											</div>
										</div>
										
										<!--- ADD BADGE -->
										<div class="tab-pane" id="addBadge">
											<div class="row">
												<div class="col-md-12">
													<h5 class="mb-3"></h5>
													<div class="form-group">
														<label for="input-1">Name</label>
														<input type="text" class="form-control" name = "addedName" id = "addedName" placeholder="" required>
													</div>
														
													<div class="form-group">
														<label for="input-1">Type</label>
														<select  class="form-control" name="addedType" id="addedType">
														    <option value="Technical Skills">Technical Skills</option>
															<option value="Soft Skills">Soft Skills</option>
															<option value="Others">Others</option>
														</select>
													</div>
													<br>
													<button onclick="addNewBadge()" class="btn btn-success">Add Badge</button>
												</div>	
											</div>
										</div>
										
									</div>
								</div>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-12 col-lg-8 col-xl">
							<div class="card">
								<div class="card-body">
									<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
										<li class="nav-item">
											<a href="javascript:void();" data-target="#editExperience" data-toggle="pill" class="nav-link active"><i class="zmdi zmdi-account-box-mail"></i> <span class="hidden-xs">Edit Experience</span></a>
										</li>
										<li class="nav-item">
											<a href="javascript:void();" data-target="#addExperience" data-toggle="pill" class="nav-link"><i class="zmdi zmdi-assignment-o"></i> <span class="hidden-xs">Add Experience</span></a>
										</li>
									</ul>
									
	
									<div class="tab-content p-3">
										<!--- EDIT ABOUT -->
										<div class="tab-pane" id="addExperience">
											<div class="row">
												<div class="col-lg-12">
													<div class="card">
														<div class="card-body">
															<div class="card-title">Add Experience</div>
															<hr>
															
															<!----  Form  ---->
															<form method="POST" action="assets/php/process_addExperience.php" id="experienceForm" onsubmit="return validateDates()">
																<!----  Type  ---->
																<div class="form-group">
																	<label for="input-1">Type</label>
																	<div class="position-relative has-icon-right">
																		<select class="form-control" id="input_1" name = "input_1">
																			<option value="Part-time">Part-time job</option>
																			<option value="Full-time">Full-time job</option>
																			<option value="Club">Club</option>
																			<option value="Association">Association</option>
																		</select>
																	</div>
																</div>
																
																
																<div class="form-group">
																	<label for="input-1">COMPANY/CLUB/ASSOCATIATION</label>
																	<div class="position-relative has-icon-right">
																		<input type="text" id="input_2" name="input_2" class="form-control input-shadow" placeholder="Enter Organization" required>
																	</div>
																</div>
																
																<div class="form-group">
																	<label for="input-3">Position</label>
																	<input type="text" class="form-control" name = "input_3" id="input_3" placeholder="Enter Position" required>
																</div>
																
																<div class="form-group">
																	<label for="input-4">Start Date</label>
																	<input type="date" class="form-control" name = "input_4" id="input_4" required>
																</div>

																<div class="form-group">
																	<label for="input-5">End Date</label>
																	<input type="date" class="form-control" name = "input_5" id="input_5" required>
																</div>
																
																<div class="form-group">
																	<label for="input-6">Description</label>
																	<textarea id = "input_6" name = "input_6" class="form-control" rows="10" placeholder="Enter Description" required></textarea>
																</div>
																
																<button type="submit" value="Submit" class="btn btn-light btn-block btn-success">Add Experience</button>
															</form>
																
														
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<!--- EDIT EXPERIENCE -->
										<div class="tab-pane active" id="editExperience">
											<div class="row" style="overflow-y: scroll; max-height: 600px;">
												<?php
												include("assets/php/connection.php");
												$results_per_page = 2; // Number of rows to display per page
												$sql = "SELECT * FROM experience WHERE user_ID = '{$_SESSION['user_ID']}'";
												$result = mysqli_query($connection, $sql);

												if (mysqli_num_rows($result) > 0) {
												  while ($row = mysqli_fetch_assoc($result)) {
													?>	
													<div class="col-md-12">
													  <h5 style="display:"><?php echo $row['position'];?></h5>
													  <?php echo $row['type']." - ".$row['groupName']; ?>
													  <?php echo "<br>";?>
													  <?php echo $row['duration']; ?>
													  <?php echo "<br><br>";?>
													 
													  <a href="editExperience.php?exp_ID=<?php echo $row['exp_ID']; ?>" class="btn btn-primary">Edit</a>
													  <?php echo "<br><hr>";?>
													</div>
													<?php
												  }
												} else {
												  echo "No experiences found.";
												}
												?>
											</div>
										</div>
										
										
									</div>
								</div>
							</div>
						</div>
						
						<!--- 2nd Content	 -->
						<div class="col-12 col-lg-8 col-xl">	
							<div class="card">
								<div class="card-body">
									<div class="tab-pane active" id="picture">
										<div class="row">
											<div class="col-md-12">
												<h5 class="mb-3">Pictures</h5>
												<div class="form-group">
													<label for="input-1">Profile Picture</label>
													<form id="profilePictureForm" enctype="multipart/form-data" action="assets/php/process_editProfilePicture.php" method="post">
														<input type="file" name="profile_picture" id="profile_picture" style="display: none">
														<button type="button" id="chooseProfileFileButton" class="btn btn-primary">Choose Profile Picture</button>
														<input type="button" id="cropAndUploadProfile" class="btn btn-success" value="Crop and Upload" style="display: none">
													</form>
												</div>

												<div class="form-group">
													<label for="input-2">Banner</label>
													<form id="bannerForm" enctype="multipart/form-data" action="assets/php/process_editBanner.php" method="post">
														<input type="file" name="banner_picture" id="banner_picture" style="display: none">
														<button type="button" id="chooseBannerFileButton" class="btn btn-primary">Choose Banner</button>
														<input type="button" id="cropAndUploadBanner" class="btn btn-success" value="Crop and Upload" style="display: none">
													</form>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
						

						<div id="message"></div>

						<div class="crop-container">
							<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.css">
							<!-- Crop Modal for Profile Picture -->
							<div class="modal fade" id="profileCropModal" tabindex="-1" role="dialog" aria-labelledby="profileCropModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="profileCropModalLabel">Crop Profile Picture</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body text-center d-flex justify-content-center align-items-center">
											<canvas id="profileCroppedCanvas" width="110" height="110"></canvas>
										</div>

										<div class="modal-footer justify-content-center">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary" id="confirmProfileCrop">Confirm Crop</button>
										</div>
									</div>
								</div>
							</div>

							<!-- Crop Modal for Banner -->
							<div class="modal fade" id="bannerCropModal" tabindex="-1" role="dialog" aria-labelledby="bannerCropModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class "modal-title" id="bannerCropModalLabel">Crop Banner</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body text-center d-flex justify-content-center align-items-center">
											<canvas id="bannerCroppedCanvas" width="800" height="500"></canvas>
										</div>

										<div class="modal-footer justify-content-center">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary" id="confirmBannerCrop">Confirm Crop</button>
										</div>
									</div>
								</div>
							</div>
						</div>
				</div>



				<script>
					var profileCropper;
					var bannerCropper;

					$('#chooseProfileFileButton').click(function() {
						$('#profile_picture').click();
					});

					$('#chooseBannerFileButton').click(function() {
						$('#banner_picture').click();
					});

					$('#profile_picture').change(function() {
						var input = this;
						if (input.files && input.files[0]) {
							var reader = new FileReader();
							reader.onload = function(e) {
								if (profileCropper) {
									profileCropper.replace(e.target.result);
								} else {
									profileCropper = new Cropper(document.getElementById('profileCroppedCanvas'), {
										aspectRatio: 1,
										viewMode: 2,
									});

									profileCropper.replace(e.target.result);
								}
								$('#profileCropModal').modal('show');
							};
							reader.readAsDataURL(input.files[0]);
						}
					});

					$('#banner_picture').change(function() {
						var input = this;
						if (input.files && input.files[0]) {
							var reader = new FileReader();
							reader.onload = function(e) {
								if (bannerCropper) {
									bannerCropper.replace(e.target.result);
								} else {
									bannerCropper = new Cropper(document.getElementById('bannerCroppedCanvas'), {
										aspectRatio: 16 / 9, // Set your desired aspect ratio for the banner image
										viewMode: 2,
									});

									bannerCropper.replace(e.target.result);
								}
								$('#bannerCropModal').modal('show');
							};
							reader.readAsDataURL(input.files[0]);
						}
					});

					$('#confirmProfileCrop').click(function() {
						if (profileCropper) {
							var canvas = profileCropper.getCroppedCanvas({ width: 110, height: 110 });
							if (canvas) {
								canvas.toBlob(function(blob) {
									var formData = new FormData();
									formData.append('profile_picture', blob);
									$.ajax({
										url: 'assets/php/process_editProfilePicture.php',
										method: 'POST',
										data: formData,
										processData: false,
										contentType: false,
										success: function(response) {
											if(response.imageData){
												alert("Your profile picture is updated!");
												
												var newImageData = response.imageData;

												// Find the <img> element with the id 'smallProfilePicture_1' and 'smallProfilePicture_2'
												var imgElement = document.getElementById('smallProfilePicture_1');
												var imgElement_2 = document.getElementById('smallProfilePicture_2');

												// Update the 'src' attribute of the <img> element with the new image data
												imgElement.src = "data:image/jpeg;base64," + newImageData;
												imgElement_2.src = "data:image/jpeg;base64," + newImageData;

												$('#profileCropModal').modal('hide');
											}
											else{
												alert("Image data is empty or null. Failed to update image.");

											}
											
											
										}
									});
								});
							}
						}
					});

					$('#confirmBannerCrop').click(function() {
						if (bannerCropper) {
							var canvas = bannerCropper.getCroppedCanvas({ width: 800, height: 500 }); // Set your desired dimensions for the banner image
							if (canvas) {
								canvas.toBlob(function(blob) {
									var formData = new FormData();
									formData.append('banner_picture', blob);
									$.ajax({
										url: 'assets/php/process_editBanner.php',
										method: 'POST',
										data: formData,
										processData: false,
										contentType: false,
										success: function(response) {
											alert("Your banner picture is updated!");
											$('#bannerCropModal').modal('hide');
										}
									});
								});
							}
						}
					});

					$('#profileCropModal, #bannerCropModal').on('hidden.bs.modal', function () {
						$('#profile_picture, #banner_picture').val('');
						if (profileCropper) {
							profileCropper.destroy();
						}
						if (bannerCropper) {
							bannerCropper.destroy();
						}
					});

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
					  
						<ul class="switcher">a
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

			<script>
				function saveChanges() {
					var badges = document.getElementsByClassName("badge-input");
															  
					for (var i = 0; i < badges.length; i++) {
						var badge_ID = badges[i].id.split("_")[1];
						var badgeName = badges[i].value;										
						updateBadgeName(badge_ID, badgeName);
					}
															  
					alert("Changes saved successfully!");
				}

				function updateBadgeName(badge_ID, badgeName) {
					$.ajax({
						url: 'assets/php/process_updateBadge.php',
						method: 'POST',
						data: { badge_ID: badge_ID, badgeName: badgeName },
						success: function(response) {
						// Handle the response from the PHP script
							console.log(response);
						},
						error: function(xhr, status, error) {
							// Handle the error
							console.log(error);
						}
					});
				}
				
			

				

			
				
				function updateProfile() {
					var newMatricNumValue = document.getElementById("matricNum").value;
					var newMobileValue = document.getElementById("mobile").value;
					var newPositionValue = document.getElementById("position").value;
					var newAboutValue = document.getElementById("newAbout").value;

					var formData = new FormData();
					formData.append("matricNum", newMatricNumValue);
					formData.append("mobile", newMobileValue);
					formData.append("position", newPositionValue);
					formData.append("about", newAboutValue);

					var xhr = new XMLHttpRequest();
					xhr.open("POST", "assets/php/process_editProfile.php", true);
					xhr.onreadystatechange = function() {
						if (xhr.readyState === 4 && xhr.status === 200) {
							console.log(xhr.responseText);
						}
					};

					xhr.send(formData);
					alert("Changes saved successfully!");
				}



				
				
				function validateDates() {
					var startDate = new Date(document.getElementById("input_4").value);
					var endDate = new Date(document.getElementById("input_5").value);

				    if (startDate > endDate) {
						alert("Start date cannot be greater than end date.");
						return false; // Prevent form submission
					}

					return true; // Allow form submission
				}




				function addNewBadge() {
					
					var addedNameInput = document.getElementById("addedName");
					var addedName = addedNameInput.value;
					  
					// Check if the input name is empty
					if (addedName.trim() === "") {
						alert("Please enter a name for the badge.");
						return; // Stop further execution
					}
					  
					var addedTypeInput = document.getElementById("addedType");
					var addedType = addedTypeInput.value;
					
				
					$.ajax({
						url: 'assets/php/process_addBadge.php',
						method: 'POST',
						data: { addedName: addedName, addedType: addedType },
						success: function(response) {
						// Handle the response from the PHP script
							console.log(response);
						},
						error: function(xhr, status, error) {
							// Handle the error
							console.log(error);
						}
					});
					
					alert("A new badge has been added!");
					// Reload the current page
					location.reload();
				

				}			
														
				function deleteBadge(badgeID) {
					$.ajax({
						url: 'assets/php/process_deleteBadge.php',
						method: 'POST',
						data: { badgeID: badgeID },
						success: function(response) {
							// Handle the response from the PHP script
							console.log(response);
						},
						error: function(xhr, status, error) {
							// Handle the error
							console.log(error);
						}
					});		
					alert("The badge has been deleted!");
				}
			</script>		
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