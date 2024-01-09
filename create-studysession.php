<?php
  session_start();

  // Check if the session variable exists
	if (!isset($_SESSION['user_ID'])) {
		// Redirect to the login page
		header("Location: login.html");
		exit();
	}
	else {
		
		include("assets/php/connection.php");

		if (isset($_GET['studyhub_ID'])) {
			$studyhub_ID = $_GET['studyhub_ID'];
		}

	}
  
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<meta name="description" content=""/>
		<meta name="author" content=""/>
		<title>Create Study Session</title>
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

		<style>
			.time-button {
				margin-right: 10px; 
				margin-top: 10px;
			}
		</style>
		
	</head>

	<body class="bg-theme bg-theme9">
		<div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
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
								<i class="fa fa-envelope-open-o"></i>
							</a>
						</li>
						<li class="nav-item dropdown-lg">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
								<i class="fa fa-bell-o"></i>
							</a>
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
								<span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li class="dropdown-item user-details">
									<a href="myProfile.php">
										<div class="media">
											<div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
											<div class="media-body">
												<h6 class="mt-2 user-title"><?php echo $_SESSION["name"];?></h6>
												<p class="user-subtitle"><?php echo $_SESSION["email"];?></p>
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

								<li class="dropdown-divider"></li>
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


			<div class="clearfix"></div>
    
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row mt-3">
						<div class="col-lg-6">
							<div class="card">
								<div class="card-body">
									<div class="card-title">Create Study Session</div>
									<hr>	
									<!--Group Application - Form-->
									<form action="assets/php/process_createStudySession.php" method="POST">

										<input type="hidden" name="studyhub_ID" value="<?php echo $studyhub_ID; ?>">

										<!--Session Name-->
										<div class="form-group">
											<label for="input-1">Session Name:</label>
											<input type="text" class="form-control" id="input-1" name="studysession_name" placeholder="Session name">
										</div>

										<!--Session Date-->
										<div class="form-group">
											<label for="input-2">Session Date:</label>
											<input type="date" class="form-control" id="input-2" name="studysession_date" placeholder="Session date" onchange="handleDateChange(this)">
										</div>

										<!--Session Time-->
										<div class="form-group">
											<label for="input-3">Session Time:</label>
											<input type="time" class="form-control" id="input-3" name ="studysession_time" placeholder="Session time">
										</div>

										<!--Session Mode-->
										<div class="form-group">
											<label for="input-4">Session Mode:</label>

											<br> 

											<input type="radio" id="option1" name="studysession_mode" value="Online">
											<label for="option1">Online</label>
											&nbsp;&nbsp;
											<input type="radio" id="option2" name="studysession_mode" value="Physical">
											<label for="option2">Physical</label>									  
										</div>

										<!--Session Link-->
										<div class="form-group">
											<label for="input-5">Session Link:</label>
											<input type="text" class="form-control" id="input-5" name ="studysession_link" placeholder="Session link">
										</div>

										<!--Session Note-->
										<div class="form-group">
											<label for="input-6">Note:</label>
											<input type="text" class="form-control" id="input-6" name="note" placeholder="Note">
										</div>

										<!--Submit Button - Create Session-->
										<center><button type="submit" class="btn btn-success"><i class=""></i>Create Session</button></center>
										<center><a href="javascript:history.back()" class="btn btn-light" style="margin-top: 10px">Back</a></center>
										

									</form>
								</div>
							</div>
						</div>


						<!--SUGESSTED TIME BASED ON DATE-->
						<!--ONLY SHOWN AFTER USER HAS CHOSEN THE DATE-->
						<div class="col-lg-6" id="suggestedTimeCard" style="display: none">
							<div class="card">
								<div class="card-body">
									<div class="card-title">Suggested Time</div>
									<hr>

									<!--Display chosen date and time-->
									<div class="row" >
										<div class="col" id="suggestedTimeCardContent">
											<p>Selected Date: <span id="displaySelectedDate"></span></p>
											<p>Selected Day: <span id="displaySelectedDay"></span></p>
										</div>
									</div>

									<div class="row" >
										<div class="col" id="timeButtons">
											<!-- Array data will be added here by JavaScript -->
										</div>
									</div>

								</div>
							</div>
						</div>

						<div class="overlay toggle-menu"></div>
					</div>
				</div>
			</div>
			<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
		
			<footer class="footer">
				<div class="container">
					<div class="text-center">
					</div>
				</div>
			</footer>
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
		</div>


		<!-- Bootstrap core JavaScript-->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>

		<script>
			function showSuggestedTime(dateInput) {
				// Get the "Suggested Time" card container
				var suggestedTimeCard = document.getElementById("suggestedTimeCard");

				// Check if a date has been selected
				if (dateInput.value) {
					suggestedTimeCard.style.display = "block"; // Show the card
				} else {
					suggestedTimeCard.style.display = "none"; // Hide the card
				}
			}

			var selectedDay; 

			function sendSelectedDate(dateInput) {
				var selectedDate = dateInput.value;
				selectedDay = new Date(selectedDate).toLocaleDateString('en-US', { weekday: 'long' });
				

				var displayElement = document.getElementById("suggestedTimeCardContent"); 

				// Update the displayed selected date and day
				document.getElementById("displaySelectedDate").textContent = selectedDate;
				document.getElementById("displaySelectedDay").textContent = selectedDay;

				displaySuggestedStartTimes(selectedDay, <?php echo $studyhub_ID; ?>);

				// Show the card
				var suggestedTimeCard = document.getElementById("suggestedTimeCard");
				suggestedTimeCard.style.display = "block";

			}

			function handleDateChange(dateInput) {
				showSuggestedTime(dateInput);
				sendSelectedDate(dateInput);
			}

			function generateTimeArray() {
				var startTime = 9; // Start time in 24-hour format (9 AM)
				var endTime = 17; // End time in 24-hour format (5 PM)

				var timeArray = [];

				for (var i = startTime; i <= endTime; i++) {
					var hour = i < 10 ? '0' + i : i;
					var time = hour + ':00:00';
					timeArray.push(time);
				}

				return timeArray;
			}

			// Generate time Array
			var timeArray = generateTimeArray();

			// Display the available start time after user select a date
			function displaySuggestedStartTimes(selectedDay, studyhub_ID) {
				fetch('assets/php/fetch_userScheduleByDay.php', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded',
					},
					body: 'selectedDay=' + encodeURIComponent(selectedDay) + '&studyhub_ID=' + encodeURIComponent(studyhub_ID),
				})
				.then(response => response.json())
				.then(data => {
					console.log(data);

					// Reset timeCount & timePercent to 0 when the button is clicked
					var timeCount = new Array(timeArray.length).fill(0);
					var timePercent = new Array(timeArray.length).fill(0);
					
					// Iterate through each user's schedules
					data.forEach(userSchedule => {
						var userID = userSchedule.user_ID;
						var schedules = userSchedule.schedule;

						console.log('User ID:', userID);
						// Iterate through schedules for each user
						schedules.forEach(schedule => {
							console.log('Start Time:', schedule.start_time);
							console.log('Duration:', schedule.duration);
							
							// Iterate through time slots
							for (var i = 0; i < timeArray.length; i++){
								// If start time  equal to time slot, time count +1
								if (schedule.start_time == timeArray[i]){
									timeCount[i]++;
									// If duration of schedule == 2, move to the next time slot and increase time count
									if (schedule.duration == 2){
										i++;
										timeCount[i]++;
									}
								}
								
							}

						});

						
					});

					for (var i = 0; i < timeCount.length; i++){
						console.log(timeArray[i], ': ', timeCount[i]);
							
					}

					

					// Count the percentage of available student for specific timeslot
					for (var i = 0; i < timeCount.length; i++){
						
						timePercent[i] = (data.length - timeCount[i]) / data.length;
						console.log(timeArray[i], ': ', timePercent[i]);
						
					}

					createButtons(selectedDay, timePercent);

				})
				.catch(error => {
					console.error('Error:', error);
				});

			}

			function createButtons(selectedDay, timePercent){
				// Array of times
				var times = ["09:00 AM", "10:00 AM", "11:00 AM", "12:00 PM", "01:00 PM", "02:00 PM", "03:00 PM", "04:00 PM", "05:00 PM"];

				// Get the container for time buttons
				var timeButtons = document.getElementById("timeButtons");

				// Clear existing button
				timeButtons.innerHTML = "";

				// Loop through the array and create a button for each time
				// Only timeslot with more than 70% of students available are displayed for suggestions
				for (var i = 0; i < times.length; i++) {

					if (timePercent[i] >= 0.7) {
						var button = document.createElement("button");

						var timeStr = times[i];

						// Split the time string into hours, minutes, and AM/PM parts
						var [time, ampm] = timeStr.split(' ');

						// Split the time part into hours and minutes
						var [hours, minutes] = time.split(':');

						// Convert hours and minutes to integers
						hours = parseInt(hours);
						minutes = parseInt(minutes);

						// Adjust hours for PM times
						if (ampm === 'PM' && hours !== 12) {
							hours += 12;
						}

						// Create a Date object with the chosen time
						var chosenTime = new Date();
						chosenTime.setHours(hours, minutes);

						console.log(chosenTime);

						button.textContent = times[i];
						button.className = "btn btn-light time-button";

						// Create a closure to capture the chosenTime for each button
						(function(chosenTime) {
							button.addEventListener("click", function() {
								// Get the Session Time input field
								var sessionTimeInput = document.getElementById("input-3");
								// Update the Session Time input when a button is clicked
								sessionTimeInput.value = chosenTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
							});
						})(chosenTime);

						timeButtons.appendChild(button);

					}
				}

			}
			

		</script>
    
		<!-- simplebar js -->
		<script src="assets/plugins/simplebar/js/simplebar.js"></script>
		<!-- sidebar-menu js -->
		<script src="assets/js/sidebar-menu.js"></script>
    
		<!-- Custom scripts -->
		<script src="assets/js/app-script.js"></script>
		<script src="assets/js/inviteMM.js"></script>
		
	</body>
</html>

