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
      <input type="text" id="emailHolder" class="form-control input-shadow" style="display:none;">
      <div class="height-100v d-flex align-items-center justify-content-center">
        <div class="card card-authentication1 mb-0" id="sendEmailContent">
          <div class="card-body">
            <div class="card-content p-2">
              <div class="card-title text-uppercase pb-2">Reset Password</div>
              <p class="pb-2">Please enter your email address. You will receive a link to create a new password via email.
              </p>
              <div id="resetForm">
                <div class="form-group">
                  <label for="exampleInputEmailAddress" class="">Email Address</label>
                  <div class="position-relative has-icon-right">
                    <input type="text" id="input-email" class="form-control input-shadow" placeholder="Email Address">
                    <div class="form-control-position">
                      <i class="icon-envelope-open"></i>
                    </div>
                  </div>
                </div>

                <button onclick=checkEmail() class="btn btn-success btn-block mt-3">Reset Password</button>
              </div>
            </div>
          </div>
          <div class="card-footer text-center py-3">
            <p class="text-warning mb-0">Return to the <a href="login.php"> Sign In</a></p>
          </div>
        </div>

        <!-- Token Session -->
        <div class="card card-authentication1 mb-0" id="insertTokenContent" style="display:none;">
          <div class="card-body">
            <div class="card-content p-2">
              <div class="card-title text-uppercase pb-2">Reset Password</div>
              <div id="tokenForm">
                <div class="form-group">
                  <label for="exampleInputEmailAddress" class="">Reset Token</label>
                  <div class="position-relative has-icon-right">
                    <input type="text" id="input-token" class="form-control input-shadow" placeholder="Token">
                    <div class="form-control-position">

                    </div>
                  </div>
                </div>

                <button onclick=checkToken(); class="btn btn-success btn-block mt-3">Verify</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End of Token Session -->


        <!-- Set New Password -->
        <div class="card card-authentication1 mb-0" id="newPasswordForm" style="display:none;">
          <div class="card-body">
            <div class="card-content p-2">
              <div class="card-title text-uppercase pb-2">New Password</div>
              <div id="tokenForm">
                <div class="form-group">
                  <label for="exampleI" class="">Set New Password</label>
                  <div class="position-relative has-icon-right">
                    <input type="password" id="input-pass-1" class="form-control input-shadow" placeholder="New password">
                    <div class="form-control-position">

                    </div>
                  </div>

                  <br>
                  <label for="exampleI" class="">Re-enter Password</label>
                  <div class="position-relative has-icon-right">
                    <input type="password" id="input-pass-2" class="form-control input-shadow"
                      placeholder="Re-enter new password">
                    <div class="form-control-position">

                    </div>
                  </div>
                </div>

                <button onclick=submitNewPassword() class="btn btn-success btn-block mt-3">Reset</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End of Set New Password -->
      </div>

      <!--Start Back To Top Button-->
      <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
      <!--End Back To Top Button-->

    </div><!--wrapper-->

    <!-- Bootstrap core JavaScript-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- sidebar-menu js -->
    <script src="assets/js/sidebar-menu.js"></script>

    <!-- Custom scripts -->
    <script src="assets/js/app-script.js"></script>

    <script>
      function checkToken() {
        var token = document.getElementById("input-token").value;
        $.ajax({
          url: 'assets/php/process_checkToken.php',
          method: 'POST',
          data: { token: token },
          success: function (response) {
            if (response === "Token does not exist.") {
              alert("The token is not correct. Please try again.");
            }

            else {
              console.log(response);
              document.getElementById("sendEmailContent").style.display = "none";
              document.getElementById("insertTokenContent").style.display = "none";
              document.getElementById("newPasswordForm").style.display = "block";
            }
          },
          error: function (xhr, status, error) {
            console.log(response);
          }
        });

      }

      function checkEmail() {
        var email = document.getElementById("input-email").value;
        $.ajax({
          url: 'assets/php/process_checkEmail.php',
          method: 'POST',
          data: { email: email },
          success: function (response) {
            if (response === "Email does not exist.") {
              alert("The email doesn't exist in our record. Please try again.");
            }

            else {
              resetPassword(email);
            }
          },
          error: function (xhr, status, error) {
            console.log(response);
          }
        });

      }

      function resetPassword(email) {
        $.ajax({
          url: 'assets/php/process_sendEmail.php',
          method: 'POST',
          data: { email: email },
          success: function (response) {
            alert("Recovery email has been sent. Please check your inbox."); console.log(response);
            document.getElementById("sendEmailContent").style.display = "none";
              document.getElementById("insertTokenContent").style.display = "block";
             
            document.getElementById("emailHolder").value = email;
          },
          error: function (xhr, status, error) {
            console.log(response);
          }
        });

      }

      function submitNewPassword() {
        const passwordField = document.getElementById("input-pass-1");
        const confirmPasswordField = document.getElementById("input-pass-2");
        const passwordValue = passwordField.value;
        const confirmPasswordValue = confirmPasswordField.value;

        if (passwordValue !== confirmPasswordValue) {
          alert("Passwords do not match. Please try again.");
        } else {
          var email = document.getElementById("emailHolder").value;
          $.ajax({
            url: 'assets/php/process_newPassword.php',
            method: 'POST',
            data: { password: passwordValue, email: email }, // Use passwordValue instead of passwordField
            success: function (response) {

              alert("A new password has been set. Please proceed to login");
              window.location.href = "login.php";
            },
            error: function (xhr, status, error) {
              console.log("Error"); // Log the error
            }
          });
        }
      }



    </script>

  </body>

  </html>

  <?php
}
?>