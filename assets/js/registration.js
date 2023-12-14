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

const form = document.querySelector("form");
const passwordField = document.getElementById("password");
const confirmPasswordField = document.getElementById("confirmPassword");

form.addEventListener("submit", function (event) {
  const passwordValue = passwordField.value;
  const confirmPasswordValue = confirmPasswordField.value;

  if (passwordValue !== confirmPasswordValue) {
    event.preventDefault();
    alert("Passwords do not match. Please try again.");
  }
});

const emailField = document.getElementById("email");

emailField.addEventListener("blur", function () {
  const emailValue = emailField.value;

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "assets/php/check_email.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      const response = xhr.responseText;
      if (response !== "") {
        alert(response);
        emailField.value = "";
        emailField.focus();
      }
    }
  };
  xhr.send("email=" + emailValue);
});

function register() {
  var name = document.getElementById("name").value;
  var email = document.getElementById("email").value;
  var mobile = document.getElementById("mobile").value;
  var matricNum = document.getElementById("matricNum").value;
  var year = document.getElementById("year").value;
  var department = document.getElementById("department").value;
  var password = document.getElementById("password").value;

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
  xhr.open("POST", "assets/php/process_registration.php", true);
  xhr.setRequestHeader("Content-Type", "application/json"); // Set the content type to JSON

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        console.log(xhr.responseText);
        alert(
          "You have successfully registered!\nPlease proceed with logging in."
        );
        window.location.href = "login.php";
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
