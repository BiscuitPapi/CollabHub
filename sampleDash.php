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
		<title>Edit Profile</title>
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
				font-size: 18px;
				/* Adjust the font size to make the X button bigger */
				margin-left: 5px;
				/* Add some spacing between the input field and the X button */
				padding: 4px 8px;
				text-decoration: none;
				margin-left: 5px;
				/* Add some spacing between the input field and the X button */
				margin-right: -10px;
				/* Move the X button towards the right edge of the badge */
			}

			.badge-pill {
				display: flex;
				align-items: center;
			}

			.badge-input {
				width: 60%;
				/* Adjust the width as per your preference */
				display: inline-block;
				vertical-align: middle;
			}

			.badge-name {
				margin-right: 5px;
				/* Add some spacing between the badge name and input field */
			}
		</style>

	</head>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<center>
							<div class="col-1">
								<div class="row">
									<a href="javascript:void();" data-toggle="tooltip" data-placement="top"
										title="Personal Information" onclick="toggle('about');">
										<div class="card">
											<div class="card-body">
												<center>
													<i class="zmdi zmdi-account"></i><span></span>
												</center>
											</div>
										</div>
									</a>
								</div>

								<div class="row">
									<a href="javascript:void();" data-toggle="tooltip" data-placement="top" title="Badge"
										onclick="toggle('addBadge');">
										<div class="card">
											<div class="card-body">
												<center>
													<i class="zmdi zmdi-badge-check"></i><span></span>
												</center>
											</div>
										</div>
									</a>
								</div>

								<div class="row">
									<a href="javascript:void();" data-toggle="tooltip" data-placement="top"
										title="Experience" onclick="toggle('experience');">
										<div class="card">
											<div class="card-body">
												<center>
													<i class="zmdi zmdi-account-box-mail"></i><span></span>
												</center>
											</div>
										</div>
									</a>
								</div>

								<div class="row">
									<a href="javascript:void();" data-toggle="tooltip" data-placement="top" title="Pictures"
										onclick="toggle('pictureBanner');">
										<div class="card">
											<div class="card-body">
												<center>
													<i class="zmdi zmdi-face"></i><span></span>
												</center>
											</div>
										</div>
									</a>
								</div>

							</div>
						</center>


						<!-- New row or section -->
						<div class="col-10">
							<div class="card">
								<div class="card-body">
									<!--- PERSONAL INFORMATION TAB -->
									<div class="tab-pane" id="about">
										<div class="row">
											<div class="col-md-12">
												<h5 class="mb-3">Personal Information</h5>
												<div class="form-group">
													<label for="input-0">About</label>
													<textarea name="newAbout" id="newAbout" class="form-control"
														rows="10"><?php echo $_SESSION['about']; ?></textarea>
												</div>

												<div class="form-group">
													<label for="input-1">Position</label>
													<div class="position-relative has-icon-right">
														<input type="text" id="position" name="position"
															class="form-control input-shadow"
															value="<?php echo $_SESSION["position"]; ?>" required>
													</div>
												</div>

												<!-- Matric Number -->
												<div class="form-group">
													<label for="input-1">Matric Number</label>
													<div class="position-relative has-icon-right">
														<input type="text" id="matricNum" name="matricNum"
															class="form-control input-shadow"
															value="<?php echo $_SESSION["matricNum"]; ?>" required>
													</div>
												</div>

												<!-- Mobile Number -->
												<div class="form-group">
													<label for="input-1">Mobile Number</label>
													<div class="position-relative has-icon-right">
														<input type="text" id="mobile" name="mobile"
															class="form-control input-shadow"
															value="<?php echo $_SESSION["mobile"]; ?>" required>
													</div>
												</div>


												<br>
												<button onclick="updateProfile()" class="btn btn-primary">Save
													Changes</button>
											</div>
										</div>
									</div>
									<!--- BADGE TAB -->
									<div class="tab-content p-3" id="badge" style="display:none;">
										<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
											<li class="nav-item">
												<a href="javascript:void();" data-target="#addBadge" data-toggle="pill"
													class="nav-link active"><i class="zmdi zmdi-case-check"></i> <span
														class="hidden-xs">Add Badge</span></a>
											</li>
											<li class="nav-item">
												<a href="javascript:void();" data-target="#editBadge" data-toggle="pill"
													class="nav-link "><i class="zmdi zmdi-brush"></i> <span
														class="hidden-xs">Edit Badge</span></a>
											</li>
										</ul>

										<!--- EDIT BADGES -->
										<div class="tab-pane" id="editBadge">
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
										<div class="tab-pane active" id="addBadge">
											<div class="row">
												<div class="col-md-12">
													<h5 class="mb-3"></h5>
													<div class="form-group">
														<label for="input-1">Name</label>
														<input type="text" class="form-control" name="addedName"
															id="addedName" placeholder="" required>
													</div>

													<div class="form-group">
														<label for="input-1">Type</label>
														<select class="form-control" name="addedType" id="addedType">
															<option value="Technical Skills">Technical Skills</option>
															<option value="Soft Skills">Soft Skills</option>
															<option value="Others">Others</option>
														</select>
													</div>
													<br>
													<button onclick="addNewBadge()" class="btn btn-success">Add
														Badge</button>
												</div>
											</div>
										</div>

									</div>

									<!--- EXPERIENCE TAB -->
									<div class="tab-content p-3" id="experience" style="display:none;">
										<ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
											<li class="nav-item">
												<a href="javascript:void();" data-target="#editExperience"
													data-toggle="pill" class="nav-link active"><i
														class="zmdi zmdi-account-box-mail"></i> <span class="hidden-xs">Edit
														Experience</span></a>
											</li>
											<li class="nav-item">
												<a href="javascript:void();" data-target="#addExperience" data-toggle="pill"
													class="nav-link"><i class="zmdi zmdi-assignment-o"></i> <span
														class="hidden-xs">Add Experience</span></a>
											</li>
										</ul>
										<br>
										<div class="tab-pane" id="addExperience">
											<div class="row">
												<div class="col-lg-12">
													<div class="card">
														<div class="card-body">
															<div class="card-title">Add Experience</div>
															<hr>

															<!----  Form  ---->
															<form method="POST"
																action="assets/php/process_addExperience.php"
																id="experienceForm" onsubmit="return validateDates()">
																<!----  Type  ---->
																<div class="form-group">
																	<label for="input-1">Type</label>
																	<div class="position-relative has-icon-right">
																		<select class="form-control" id="input_1"
																			name="input_1">
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
																		<input type="text" id="input_2" name="input_2"
																			class="form-control input-shadow"
																			placeholder="Enter Organization" required>
																	</div>
																</div>

																<div class="form-group">
																	<label for="input-3">Position</label>
																	<input type="text" class="form-control" name="input_3"
																		id="input_3" placeholder="Enter Position" required>
																</div>

																<div class="form-group">
																	<label for="input-4">Start Date</label>
																	<input type="date" class="form-control" name="input_4"
																		id="input_4" required>
																</div>

																<div class="form-group">
																	<label for="input-5">End Date</label>
																	<input type="date" class="form-control" name="input_5"
																		id="input_5" required>
																</div>

																<div class="form-group">
																	<label for="input-6">Description</label>
																	<textarea id="input_6" name="input_6"
																		class="form-control" rows="10"
																		placeholder="Enter Description" required></textarea>
																</div>

																<button type="submit" value="Submit"
																	class="btn btn-light btn-block btn-success">Add
																	Experience</button>
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
															<h5 style="display:">
																<?php echo $row['position']; ?>
															</h5>
															<?php echo $row['type'] . " - " . $row['groupName']; ?>
															<?php echo "<br>"; ?>
															<?php echo $row['duration']; ?>
															<?php echo "<br><br>"; ?>

															<a href="editExperience.php?exp_ID=<?php echo $row['exp_ID']; ?>"
																class="btn btn-primary">Edit</a>
															<?php echo "<br><hr>"; ?>
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

									<div class="tab-content p-3" id="pictureBanner" style="display:none;">
										<div class="tab-pane active" id="picture">
											<div class="row">
												<div class="col-md-12">
													<h5 class="mb-3">Pictures</h5>
													<div class="form-group">
														<label for="input-1">Profile Picture</label>
														<form id="profilePictureForm" enctype="multipart/form-data"
															action="assets/php/process_editProfilePicture.php"
															method="post">
															<input type="file" name="profile_picture" id="profile_picture"
																style="display: none">
															<button type="button" id="chooseProfileFileButton"
																class="btn btn-primary">Choose Profile Picture</button>
															<input type="button" id="cropAndUploadProfile"
																class="btn btn-success" value="Crop and Upload"
																style="display: none">
														</form>
													</div>

													<div class="form-group">
														<label for="input-2">Banner</label>
														<form id="bannerForm" enctype="multipart/form-data"
															action="assets/php/process_editBanner.php" method="post">
															<input type="file" name="banner_picture" id="banner_picture"
																style="display: none">
															<button type="button" id="chooseBannerFileButton"
																class="btn btn-primary">Choose Banner</button>
															<input type="button" id="cropAndUploadBanner"
																class="btn btn-success" value="Crop and Upload"
																style="display: none">
														</form>
													</div>

												</div>
											</div>
										</div>
									</div>

									<div class="crop-container">
										<link rel="stylesheet"
											href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.css">
										<!-- Crop Modal for Profile Picture -->
										<div class="modal fade" id="profileCropModal" tabindex="-1" role="dialog"
											aria-labelledby="profileCropModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="profileCropModalLabel">Crop Profile
															Picture</h5>
														<button type="button" class="close" data-dismiss="modal"
															aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div
														class="modal-body text-center d-flex justify-content-center align-items-center">
														<canvas id="profileCroppedCanvas" width="110" height="110"></canvas>
													</div>

													<div class="modal-footer justify-content-center">
														<button type="button" class="btn btn-secondary"
															data-dismiss="modal">Close</button>
														<button type="button" class="btn btn-primary"
															id="confirmProfileCrop">Confirm Crop</button>
													</div>
												</div>
											</div>
										</div>

										<!-- Crop Modal for Banner -->
										<div class="modal fade" id="bannerCropModal" tabindex="-1" role="dialog"
											aria-labelledby="bannerCropModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class "modal-title" id="bannerCropModalLabel">Crop Banner</h5>
														<button type="button" class="close" data-dismiss="modal"
															aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div
														class="modal-body text-center d-flex justify-content-center align-items-center">
														<canvas id="bannerCroppedCanvas" width="800" height="500"></canvas>
													</div>

													<div class="modal-footer justify-content-center">
														<button type="button" class="btn btn-secondary"
															data-dismiss="modal">Close</button>
														<button type="button" class="btn btn-primary"
															id="confirmBannerCrop">Confirm Crop</button>
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

			<script>
				// Enable Bootstrap tooltips
				$(function () {
					$('[data-toggle="tooltip"]').tooltip()
				});

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
			<script src="assets/js/inviteMM.js"></script>
			<script src="assets/js/editProfile_2.js"></script>
			<script src="assets/js/editPictures.js"></script>

			<script>
				displayNotifications();
			</script>
	</body>

	</html>

	<?php
}
?>