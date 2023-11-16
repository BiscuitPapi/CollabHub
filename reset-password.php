<?php
session_start();
// Check if the session variable exists
if (isset($_SESSION['user_ID'])) {
  // Redirect to the login page
  header("Location: myProfile.php");
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
  <title>Reset Password</title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet" />
  <script src="assets/js/pace.min.js"></script>
  <link rel="icon" href="assets/images/CB-favi.ico" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet" />

</head>

<body class="bg-theme bg-theme9">

  <!-- Start wrapper-->
  <div id="wrapper">

    <div class="height-100v d-flex align-items-center justify-content-center">
      <div class="card card-authentication1 mb-0">
        <div class="card-body">
          <div class="card-content p-2">
            <div class="card-title text-uppercase pb-2">Reset Password</div>
            <p class="pb-2">Please enter your email address. You will receive a link to create a new password via email.</p>
            <form id="resetForm">
              <div class="form-group">
                <label for="exampleInputEmailAddress" class="">Email Address</label>
                <div class="position-relative has-icon-right">
                  <input type="text" id="exampleInputEmailAddress" class="form-control input-shadow" placeholder="Email Address">
                  <div class="form-control-position">
                    <i class="icon-envelope-open"></i>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-light btn-block mt-3">Reset Password</button>
            </form>
          </div>
        </div>
        <div class="card-footer text-center py-3">
          <p class="text-warning mb-0">Return to the <a href="login.php"> Sign In</a></p>
        </div>
      </div>
    </div>

    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

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

  </div><!--wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>

  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>

  <!-- JavaScript code for sending reset password email -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Function to send the reset password email
      function sendResetEmail(email) {
        $.ajax({
          type: 'POST',
          url: 'assets/php/send_email.php', // URL to your server-side script for sending emails
          data: {
            email: email
          },
          success: function(response) {
            console.log(response); // Log the response from the server
            // You can add further handling here, such as displaying a success message or redirecting to a confirmation page
          },
          error: function(xhr, status, error) {
            console.log(error); // Log any errors
            // You can add error handling here, such as displaying an error message to the user
          }
        });
      }

      // Handle form submission
      $('#resetForm').submit(function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var email = $('#exampleInputEmailAddress').val(); // Get the email address from the input field

        if (email) {
          sendResetEmail(email); // Call the function to send the reset password email
        } else {
          console.log('Please enter an email address.');
          // You can add further error handling here, such as displaying an error message to the user
        }
      });
    });
  </script>

</body>

</html>

<?php
}
?>
