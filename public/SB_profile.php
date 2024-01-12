<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include('../assets/php/connection.php');

// Function to encode image to base64
function encodeImage($image)
{
	return ($image !== null) ? base64_encode($image) : null;
}

// Check if the session variable exists
if (!isset($_SESSION['user_ID'])) {
	// Redirect to the login page
	header("Location: index.php");
	exit();
} else {
	// Regenerate session ID to prevent session fixation
	session_regenerate_id(true);

	if (isset($_GET['studyhub_ID']) && is_numeric($_GET['studyhub_ID'])) {
		$studyhub_ID = $_GET['studyhub_ID'];

		// Fetch the study hub profile based on the studyhub_ID using prepared statement
		$stmt = $connection->prepare("SELECT * FROM studyhub WHERE studyhub_ID = ?");
		$stmt->bind_param("i", $studyhub_ID);
		$stmt->execute();
		$result = $stmt->get_result();

		// Check if the query returned any rows
		if ($result->num_rows > 0) {
			// Study hub profile found
			$studyhub = $result->fetch_assoc();

			$_SESSION['studyhub_name'] = $studyhub['studyhub_name'];
			$_SESSION['studyhub_description'] = $studyhub['studyhub_description'];
			$_SESSION['setting'] = $studyhub['setting'];
			$date_created = $studyhub['date_created'];
			$user_ID = $studyhub['user_ID'];
			if ($_SESSION["user_ID"] != $user_ID) {
				$style = 'style="display: none;"'; // Hide the <li> element
			} else {
				$style = ''; // Show the <li> element
			}

			// Store the banner picture properly as a base64-encoded string
			$studyHub_banner = $studyhub['background_pic'];
			$banner = encodeImage($studyHub_banner);

			$studyHub_profile = $studyhub['profile_pic'];
			$proPic = encodeImage($studyHub_profile);

			$user_ID = $_SESSION["user_ID"];

			// Use prepared statement for the second query
			$stmt = $connection->prepare("SELECT i.invite_ID, sh.studyhub_ID, sh.studyhub_name, sh.profile_pic 
                                        FROM studyhub sh
                                        INNER JOIN invitation i ON sh.studyHub_ID = i.studyHub_ID
                                        WHERE i.user_ID = ?
                                        AND i.status = 'Pending'");
			$stmt->bind_param("i", $user_ID);
			$stmt->execute();
			$result = $stmt->get_result();
?>

			<!DOCTYPE html>
			<html lang="en">

			<head>
				<meta charset="utf-8" />
				<meta http-equiv="X-UA-Compatible" content="IE=edge" />
				<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
				<meta name="description" content="" />
				<meta name="author" content="" />
				<title>StudyHub</title>
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
				<link href="../assets/css/SB-profile.css" rel="stylesheet" />
				<link href="../assets/css/app-style.css" rel="stylesheet" />

				<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.css">		
			</head>


			<body class="bg-theme bg-theme9">
				<!-- Start loader -->
				<div id="pageloader-overlay" class="visible incoming">
					<div class="loader-wrapper-outer">
						<div class="loader-wrapper-inner">
							<div class="loader"></div>
						</div>
					</div>
				</div>
				<!-- End loader -->

				<!-- Start wrapper-->
				<div id="wrapper">
					<?php include_once('nav/sidebar.php'); ?>
					<?php include_once('nav/topbar.php'); ?>

					<div class="clearfix"></div>

					<div class="content-wrapper">
						<div class="container-fluid">
							<input type="text" value="<?php echo $studyhub_ID; ?>" id="dummyID" style="display:none;">

							<!-- New row or section -->
							<div class="row">
								<!-- Start of First Column -->
								<div class="col-4">
									<?php include_once('studyhub/profile-card.php'); ?>
								</div>
								<!-- End of First Column -->

								<!-- Start of Second Column -->
								<div class="col-8">
									<?php include_once('studyhub/edit-card.php'); ?>
								</div>
								<!-- End of Second Column -->

								<!-- Start of Third Column -->
								<!-- <div class="col-4">
									<?php include_once('studyhub/suggest-card.php'); ?>
								</div> -->
								<!-- End of Third Column -->
							</div>
							<!-- End of the row -->
						</div>
					</div>
					<!--End wrapper-->






					<!--Start footer-->
					<footer class="footer">
						<div class="container">
							<div class="text-center">


							</div>
						</div>
					</footer>
					<!--End footer-->

					<!-- Bootstrap core JavaScript-->
					<script src="../assets/js/jquery.min.js"></script>
					<script src="../assets/js/popper.min.js"></script>
					<script src="../assets/js/bootstrap.min.js"></script>

					<!-- simplebar js -->
					<script src="../assets/plugins/simplebar/js/simplebar.js"></script>
					<!-- sidebar-menu js -->
					<script src="../assets/js/sidebar-menu.js"></script>

					<!-- Custom scripts -->
					<script src=../assets/js/app-script.js"></script>
					<script src="../assets/js/sb-profile.js"></script>
					<script src="../assets/js/notifications.js"></script>
					<script src="../assets/js/searchAPI.js"></script>
					<script>
						displayNotifications();
					</script>
				</div>
				</div>




			</body>

			</html>

<?php
			// Reopen PHP block if necessary
		}
	} else {
		// Handle invalid input for studyhub_ID
		header("Location: myStudyHub.php");
		exit();
	}
}
?>