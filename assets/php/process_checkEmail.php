<?php
include("../connection.php");

if (isset($_POST["email"])) {
  $email = $_POST["email"];
  $sql = "SELECT * FROM user WHERE email = ?";
  
  // Create a prepared statement
  $stmt = $connection->prepare($sql);

  // Bind the email parameter
  $stmt->bind_param("s", $email);

  // Execute the statement
  $stmt->execute();

  // Get the result
  $result = $stmt->get_result();

  // Check if a row with the specified email exists
  if ($result->num_rows > 0) {
    // Email exists in the database
    echo "Email exists!";
  } else {
    // Email doesn't exist in the database
    echo "Email does not exist.";
  }

  // Close the statement
  $stmt->close();

} else {
  // Handle the case when no email is provided
  echo "Email parameter is missing.";
}

// Close the database connection
$connection->close();
?>
