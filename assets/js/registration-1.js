document
  .getElementById("submit-button")
  .addEventListener("click", function (event) {
    // Your existing logic for handling the checkbox
    if (!document.getElementById("user-checkbox1").checked) {
      event.preventDefault(); // prevent form submission
      alert(
        "Please agree to the terms and conditions before submitting the form."
      );
    } else {
      register();
    }
  });
const emailField = document.getElementById("email");

emailField.addEventListener("blur", function () {
  const emailValue = emailField.value;
  $.ajax({
    url: "../assets/php/registration/check_email.php",
    method: "POST",
    data: { email: emailValue },
    success: function (response) {
      if (response !== "") {
        alert(response);
        emailField.value = "";
        emailField.focus();
      }
      console.log(response);
    },
    error: function (xhr, status, error) {
      // Handle the error
      console.log(error);
    },
  });
});

function register() {
  var name = document.getElementById("name").value;
  var email = document.getElementById("email").value;
  var mobile = document.getElementById("mobile").value;
  var matricNum = document.getElementById("matricNum").value;
  var year = document.getElementById("year").value;
  var department = document.getElementById("department").value;
  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirmPassword").value;

  if (name == "") {
    alert("Please include your name.");
    const nameField = document.getElementById("name");
    nameField.focus();
    exit();
  }

  if (email == "") {
    alert("Please include your email.");
    const emailField = document.getElementById("email");
    emailField.focus();
    exit();
  }
  if (matricNum == "") {
    alert("Please include your matric number.");
    const matricNumField = document.getElementById("matricNum");
    matricNumField.focus();
    exit();
  }
  if (mobile == "") {
    alert("Please include your mobile phone.");
    const mobileField = document.getElementById("mobile");
    mobileField.focus();
    exit();
  }

  if (password == "") {
    alert("Password cannot be empty");
    const passwordField = document.getElementById("password");
    passwordField.focus();
    exit();
  }

  if (confirmPassword == "") {
    alert("Confirm password cannot be empty");
    const confirmPasswordField = document.getElementById("confirmPassword");
    confirmPasswordField.focus();
    exit();
  }
  const passwordField = document.getElementById("password");
  const confirmPasswordField = document.getElementById("confirmPassword");
  const passwordValue = passwordField.value;
  const confirmPasswordValue = confirmPasswordField.value;

  if (passwordValue !== confirmPasswordValue) {
    alert("Passwords do not match. Please try again.");
    exit();
  }

  // Create an object with the data to be sent
  var data = {
    name: name,
    email: email,
    mobile: mobile,
    matricNum: matricNum,
    year: year,
    department: department,
    password: password,
  };

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../assets/php/registration/process_registration.php", true);
  xhr.setRequestHeader("Content-Type", "application/json"); // Set the content type to JSON

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        console.log(xhr.responseText);
        alert(
          "You have successfully registered!\nPlease proceed with logging in."
        );
        window.location.href = "index.php";
      } else {
        console.error("Error registering new user: " + xhr.statusText);
        alert("Error registration new user. Please, try again.");
      }
    }
  };

  // Convert the data object to a JSON string
  var jsonData = JSON.stringify(data);

  // Send the JSON data in the request
  xhr.send(jsonData);
}
