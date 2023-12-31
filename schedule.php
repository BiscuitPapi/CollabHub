<?php
session_start();

// Check if the session variable exists
if (!isset($_SESSION['user_ID'])) {
  // Redirect to the login page
  header("Location: login.php");
  exit();
} else {
  // Get the user_ID from the session
  $user_ID = $_SESSION['user_ID'];

  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>My Schedule</title>
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!--favicon-->
    <link rel="icon" href="assets/images/CB-favi.ico" type="image/x-icon">
    <!--Full Calendar Css-->
    <link href="assets/plugins/fullcalendar/css/fullcalendar.min.css" rel='stylesheet' />
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

                    <tbody id="courseScheduleTableBody">

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

                <p>
                <p>
                  <center><button class="btn btn-primary" id="addCourseButton">Add Course</button></center>

              </div>

            </div>
            <!--End of table card-->

          </div>

          <!-- ADD COURSE MODAL -->
          <div id="modal" class="modal">
            <div class="modal-content" style="max-height:90vh">
              <span class="close">&times;</span>

              <!-- Form Title-->
              <center>
                <h3>Add Course</h3>
              </center>

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
                        <input type="text" class="form-control" name="addedCourse" id="input-1"
                          placeholder="Enter the course name">
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
                        <input type="time" class="form-control" id="input-3" name="addedStartTime"
                          placeholder="Enter the course start time">
                      </div>

                      <!-- Course End Time -->
                      <div class="form-group">
                        <label for="input-4">End Time:</label>
                        <input type="time" class="form-control" id="input-4" name="addedEndTime"
                          placeholder="Enter the course end time">
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
            <div class="modal-content" style="max-height:90vh">
              <span class="close" id="closeModal">&times;</span>

              <!-- Form Title-->
              <center>
                <h3>Edit Course</h3>
              </center>

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

                      <center><button type="submit" class="btn btn-success" id="editCourseButton">Edit Course</button>
                      </center>

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
      <script src="assets/js/testing.js"></script>


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

          editCourseButton.addEventListener('click', function () {
            document.getElementById("editCourseForm").submit();
          });

          // Show the modal
          var modal = document.getElementById("modal_2");
          modal.style.display = "block";
          var closeButton = modal.getElementsByClassName('close')[0];
          closeButton.addEventListener('click', function () {
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