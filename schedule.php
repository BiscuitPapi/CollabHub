<?php
session_start();

// Check if the session variable exists
if (!isset($_SESSION['user_ID'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
} 
else {
  // Get the user_ID from the session
  $user_ID = $_SESSION['user_ID']; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Dashtreme Admin - Free Dashboard for Bootstrap 4 by Codervent</title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet"/>
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!--Full Calendar Css-->
  <link href="assets/plugins/fullcalendar/css/fullcalendar.min.css" rel='stylesheet'/>
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
</head>

<body class="bg-theme bg-theme9">

   <!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
<div id="wrapper">
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
    <li class="nav-item dropdown-lg">
      <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
      <i class="fa fa-bell-o"></i></a>
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
        <a href="javaScript:void();">
           <div class="media">
             <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="mt-2 user-title">Sarajhon Mccoy</h6>
            <p class="user-subtitle">mccoy@example.com</p>
            </div>
           </div>
          </a>
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-wallet mr-2"></i> Account</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-item"><i class="icon-power mr-2"></i> Logout</li>
      </ul>
    </li>
  </ul>
</nav>
</header>
<!--End topbar header-->

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
    
      <div class="mt-3">

        <!--Table Card-->
        <div class="card">

          <div class="card-body">

          <h5 class="card-title">My Course Schedule</h5>

            <!--SCHEDULE TABLE-->
			      <div class="table-responsive">

              <table class="table table-bordered">

                <thead>
                  <tr>
                    <th scope="col" style="text-align: center;">Course Name</th>
                    <th scope="col" style="text-align: center;">Day</th>
                    <th scope="col" style="text-align: center;">Start Time</th>
                    <th scope="col" style="text-align: center;">End Time</th>
                    <th scope="col" style="text-align: center;">Action</th>

                  </tr>
                </thead>

                <tbody id ="courseScheduleTableBody">
                 
                <?php
                  include("assets/php/connection.php");

                  $dayOrder = [
                      'Monday' => 1,
                      'Tuesday' => 2,
                      'Wednesday' => 3,
                      'Thursday' => 4,
                      'Friday' => 5,
                      'Saturday' => 6,
                      'Sunday' => 7
                  ];

                  // Fetch data by order of day followed by time
                  $query = "SELECT schedule_ID, course_name, day, start_time, end_time FROM `schedule` where user_ID = '{$_SESSION['user_ID']}' 
                      ORDER BY 
                      CASE
                          WHEN day = 'Monday' THEN 1
                          WHEN day = 'Tuesday' THEN 2
                          WHEN day = 'Wednesday' THEN 3
                          WHEN day = 'Thursday' THEN 4
                          WHEN day = 'Friday' THEN 5
                          WHEN day = 'Saturday' THEN 6
                          WHEN day = 'Sunday' THEN 7
                      END,
                      start_time;";

                  $result = mysqli_query($connection, $query);

                  $count = 1; // Initialize count variable

                  // Check if there are no schedules
                  if (mysqli_num_rows($result) == 0) {
                      echo '<tr><td colspan="5">No schedule found.</td></tr>';
                  } else {
                      while ($row = mysqli_fetch_assoc($result)) {

                          // Format the time values
                          $formatted_time_start = date('g.i A', strtotime($row['start_time']));
                          $formatted_time_end = date('g.i A', strtotime($row['end_time']));

                          // Output each row of the table
                          echo '
                              <tr>
                                  <th scope="row" style="text-align: center;">' . $row['course_name'] . '</th>
                                  <td style="text-align: center;">' . $row['day'] . '</td>
                                  <td style="text-align: center;">' . $formatted_time_start . '</td>
                                  <td style="text-align: center;">' . $formatted_time_end . '</td>
                                  <td style="text-align: center;">
                                      <button class="btn btn-primary editCourseButton" data-schedule-id="' . $row['schedule_ID'] . '"
                                          data-course-name="' . $row['course_name'] . '"
                                          data-day="' . $row['day'] . '"
                                          data-start-time="' . $row['start_time'] . '"
                                          data-end-time="' . $row['end_time'] . '"
                                          onclick="editCourseModal(this)">Edit</button>
                                      <a href="assets/php/process_deleteCourseSchedule.php?schedule_ID=' . $row['schedule_ID'] . '" class="btn btn-warning">Delete</a>
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
            <!--END OF SCHEDULE TABLE-->

            <p><p>
            <center><button class="btn btn-primary" id="addCourseButton">Add Course</button></center>

          </div>

        </div>
        <!--End of table card-->

      </div>

      <!-- ADD COURSE MODAL -->
      <div id="modal" class="modal">
        <div class="modal-content" style = "max-height:90vh">
          <span class="close">&times;</span>
          
          <!-- Form Title-->
          <center><h3>Add Course</h3></center>

          <!-- Add Course to Schedule Form -->
          <div class="tab-pane" id="addCourse">
            <div class="row">
              <div class="col-md-12">
              <h5 class="mb-3"></h5>

                <br>
                  <form action="assets/php/process_addCourseSchedule.php" method="POST">
                <!-- Course Name-->
                <div class="form-group">
                  <label for="input-1">Course Name:</label>
                  <input type="text" class="form-control" name="addedCourse" id="input-1" placeholder="Enter the course name">
                </div>

                <!-- Day -->
                <div class="form-group">
                  <label for="input-2">Day:</label>
                  <select class="form-control" name="addedDay" id="input-2">
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                  </select>
                </div>
                
                <!-- Course Start Time-->
                <div class="form-group">
                    <label for="input-3">Start Time:</label>
                    <input type="time" class="form-control" id="input-3" name="addedStartTime"placeholder="Enter the course start time">
                </div>

                <!-- Course End Time -->
                <div class="form-group">
                    <label for="input-4">End Time:</label>
                    <input type="time" class="form-control" id="input-4" name="addedEndTime" placeholder="Enter the course end time">
                </div>        
              
                <center><button type="submit" class="btn btn-success">Add</button></center>
                <!-- <center><button onclick="addNewCourse()" class="btn btn-success">Add</button></center> -->
                </form>
              </div>
            </div>
          </div>

        </div>
          
      </div>
      <!-- END ADD COURSE MODAL-->

      <!-- EDIT COURSE MODAL -->
      <div id="modal_2" class="modal">
        <div class="modal-content" style = "max-height:90vh">
          <span class="close" id="closeModal">&times;</span>
          
          <!-- Form Title-->
          <center><h3>Edit Course</h3></center>

          <!-- Edit Course in the Schedule Form -->
          <div class="tab-pane" id="editCourse">
            <div class="row">
              <div class="col-md-12">
              <h5 class="mb-3"></h5>

                <br>

              <form action="assets/php/process_editCourseSchedule.php" method="POST" id="editCourseForm">
                
              <!-- Course Name-->
                <div class="form-group">
                  <label for="input-5">Course Name:</label>
                  <input type="text" class="form-control" id="input-5" name="course_name">
                </div>

                <!-- Day -->
                <div class="form-group">
                  <label for="input-6">Day:</label>
                  <select class="form-control" name="day" id="input-6">
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                  </select>
                </div>
                
                <!-- Course Start Time-->
                <div class="form-group">
                    <label for="input-7">Start Time:</label>
                    <input type="time" class="form-control" id="input-7" name="start_time">
                </div>

                <!-- Course End Time -->
                <div class="form-group">
                    <label for="input-8">End Time:</label>
                    <input type="time" class="form-control" id="input-8" name="end_time">
                </div>        

              
                <input type="hidden" id="scheduleIdInput" name="scheduleId">

                <center><button type="submit" class="btn btn-success" id="editCourseButton">Edit Course</button></center>

              </form>
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

  </div><!--End content-wrapper-->
   
  <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <script src = "assets/js/testing.js"></script>

      
    <script>

      // Get the "Add Course" button by its id
      var addCourseButton = document.getElementById('addCourseButton');

      // Get the modal and the close button
      var modal = document.getElementById('modal');
      var closeButton = modal.getElementsByClassName('close')[0];

      // Open the modal
      function openModal() {
        modal.style.display = 'block';
      }

      // Close the modal
      function closeModal() {
        modal.style.display = 'none';
      }

      addCourseButton.addEventListener('click', openModal);

      closeButton.addEventListener('click', closeModal);

      // Close the modal if the user clicks outside of it
      window.addEventListener('click', function (event) {
        if (event.target == modal) {
          closeModal();
        }
      });

      // function convertToAmPmFormat(inputTime) {
      //   var timeParts = inputTime.split(':');
      //   var hours = parseInt(timeParts[0]);
      //   var minutes = parseInt(timeParts[1]);

      //   var ampm = hours >= 12 ? 'PM' : 'AM';
      //   hours = hours % 12;
      //   hours = hours ? hours : 12; // Handle midnight (0:00) as 12:00 AM

      //   return hours + ':' + (minutes < 10 ? '0' : '') + minutes + ' ' + ampm;
      // }

      // function addNewCourse() {
      //   var addedCourseInput = document.getElementById("input-1");
      //   var addedCourse = addedCourseInput.value;

      //   var addedDayInput = document.getElementById("input-2");
      //   var addedDay = addedDayInput.value;

      //   var addedStartTimeInput = document.getElementById("input-3");
      //   var addedStartTime = addedStartTimeInput.value;

      //   var addedEndTimeInput = document.getElementById("input-4");
      //   var addedEndTime = addedEndTimeInput.value;

      //   $.ajax({
      //     url: 'assets/php/process_addCourseSchedule.php',
      //     method: 'POST',
      //     data: {
      //         addedCourse: addedCourse,
      //         addedDay: addedDay,
      //         addedStartTime: addedStartTime,
      //         addedEndTime: addedEndTime,
      //     },

      //     success: function (response) {
      //         // Split the response using the pipe character
      //         var responseParts = response.split('|');
      //         var status = responseParts[0]; // Get the status (success or error)
      //         var newScheduleID = responseParts[1]; // Get the newScheduleID

      //         var formatted_time_start = convertToAmPmFormat(addedStartTime);
      //         var formatted_time_end = convertToAmPmFormat(addedEndTime);

      //         if (status === "success") {
      //             alert("A new course has been added with ID: " + newScheduleID);
      //             closeModal();

      //             // Create a function to compare days and times
      //             function compareDayTime(a, b) {
      //                 // Compare days first
      //                 var dayComparison = a.addedDay.localeCompare(b.addedDay);
      //                 if (dayComparison !== 0) {
      //                     return dayComparison;
      //                 }
      //                 // If days are the same, compare times
      //                 return a.addedStartTime.localeCompare(b.addedStartTime);
      //             }

      //             var newSchedule = {
      //                 addedCourse: addedCourse,
      //                 addedDay: addedDay,
      //                 addedStartTime: addedStartTime,
      //                 addedEndTime: addedEndTime,
      //             };

      //             var tableRows = $('#courseScheduleTableBody tr');

      //             // Find the correct position to insert the new row
      //             var insertIndex = 0;
      //             while (insertIndex < tableRows.length) {
      //                 var rowData = {
      //                     addedDay: $(tableRows[insertIndex]).find('td:eq(1)').text(),
      //                     addedStartTime: $(tableRows[insertIndex]).find('td:eq(2)').text(),
      //                 };
      //                 if (compareDayTime(newSchedule, rowData) < 0) {
      //                     break;
      //                 }
      //                 insertIndex++;
      //             }

      //             // Insert the new row at the appropriate position
      //             var newRow = '<tr>' +
      //               '<th scope="row" style="text-align:center;">' + addedCourse + '</th>' +
      //               '<td style="text-align:center;">' + addedDay + '</td>' +
      //               '<td style="text-align:center;">' + formatted_time_start + '</td>' +
      //               '<td style="text-align:center;">' + formatted_time_end + '</td>' +
      //               '<td style="text-align:center;">' +
      //               '<button class="btn btn-primary editCourseButton" data-schedule-id="' + newScheduleID + '"' +
      //               'data-course-name="' + addedCourse + '" data-day="' + addedDay + '"  data-start-time="' + addedStartTime + '"' +
      //               'data-end-time="' + addedEndTime + '" onclick="editCourseModal(this)">Edit</button>' +
      //               '<a href="__.php?schedule_ID=' + newScheduleID + '" class="btn btn-warning">Delete</a></td>' +
      //               '</tr>';

      //             // Hide "No schedule found" message if it exists
      //             var noScheduleMessage = $('#courseScheduleTableBody td:contains("No schedule found.")');
      //             if (noScheduleMessage.length > 0) {
      //                 noScheduleMessage.parent().remove();
      //             }

      //             if (insertIndex < tableRows.length) {
      //                 $(tableRows[insertIndex]).before(newRow);
      //             } else {
      //                 $('#courseScheduleTableBody').append(newRow); // Append the new row at the end if no suitable position found
      //             }
      //         } else {
      //             alert("Error occurred");
      //         }
      //     },
      //     error: function (xhr, status, error) {
      //         // Handle the error
      //         console.log(error);
      //     }
      //   });
      // }

      function editCourseModal(button) {
        // Extract data from data attributes
        var scheduleId = button.getAttribute("data-schedule-id");
        var courseName = button.getAttribute("data-course-name");
        var day = button.getAttribute("data-day");
        var startTime = button.getAttribute("data-start-time");
        var endTime = button.getAttribute("data-end-time");

        // Populate the modal's input fields with the extracted data
        document.getElementById("input-5").value = courseName;
        document.getElementById("input-6").value = day;
        document.getElementById("input-7").value = startTime;
        document.getElementById("input-8").value = endTime;

        // Set the form action with the scheduleId
        var editCourseForm = document.getElementById("editCourseForm");
        editCourseForm.action = "assets/php/process_editCourseSchedule.php?schedule_ID=" + scheduleId;

        var editCourseButton = document.getElementById("editCourseButton");
        
        editCourseButton.addEventListener('click', function() {
          document.getElementById("editCourseForm").submit();
        });

        // Show the modal
        var modal = document.getElementById("modal_2");
        modal.style.display = "block";
        var closeButton = modal.getElementsByClassName('close')[0];
        closeButton.addEventListener('click', function() {
          modal.style.display = "none";
        });
      }

      function saveEditedCourse() {
        // Get the edited data from the modal form
        var editedCourseName = document.getElementById("input-5").value;
        var editedDay = document.getElementById("input-6").value;
        var editedStartTime = document.getElementById("input-7").value;
        var editedEndTime = document.getElementById("input-8").value;
        var scheduleID = document.getElementById("scheduleIDInput").value;

        // Create an object with the edited data
        var editedData = {
          editedCourseName: editedCourseName,
          editedDay: editedDay,
          editedStartTime: editedStartTime,
          editedEndTime: editedEndTime,
          scheduleID: scheduleID
        };

        // Send the edited data to the server using an AJAX request
        $.ajax({
          url: 'assets/php/process_editCourseSchedule.php',
          method: 'POST',
          data: editedData,
          success: function (response) {
            // Handle the response from the server
            alert("Course edited successfully");
            closeModal(); // Close the modal
          },
          error: function (xhr, status, error) {
            // Handle any errors that may occur during the AJAX request
            console.log(error);
            alert("Error occurred while editing the course");
          }
        });
      }

    </script>
  <!--End Back To Top Button-->

  

	<!--Start footer-->
	<footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © 2018 Dashtreme Admin
        </div>
      </div>
    </footer>
	<!--End footer-->
	
	<!--Start color switcher-->
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
  
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  
  <!-- Full Calendar -->
  <script src='assets/plugins/fullcalendar/js/moment.min.js'></script>
  <script src='assets/plugins/fullcalendar/js/fullcalendar.min.js'></script>
  <script src="assets/plugins/fullcalendar/js/fullcalendar-custom-script.js"></script>
	
 


</body>
</html>

<?php 

}
?>
