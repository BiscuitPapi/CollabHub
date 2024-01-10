<?php
include("connection.php");

if (isset($_POST["token"])) {
  // Assuming $_POST["token"] contains the token value you want to check
  $tokenToCheck = $_POST["token"];

  // SQL query to check if the token exists in the user table
  $sql = "SELECT token FROM user WHERE token = ?";

  // Create a prepared statement
  $stmt = $connection->prepare($sql);

  // Bind the token parameter
  $stmt->bind_param("s", $tokenToCheck);

  // Execute the statement
  $stmt->execute();

  // Get the result
  $result = $stmt->get_result();

  // Check if there are any rows with the specified token
  if ($result->num_rows > 0) {
    // Token exists in the database
    echo "Token exists!";
  } else {
    // Token does not exist in the database
    echo "Token does not exist.";
  }

  // Close the statement
  $stmt->close();


} else {
  // Handle the case when no email is provided
  echo "Token parameter is missing.";
}

// Close the database connection
$connection->close();
?>