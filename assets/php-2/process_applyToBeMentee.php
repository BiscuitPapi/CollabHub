<?php
  include("connection.php");
  session_start();

  $mentor_ID = $_POST['mentor_ID'];
  $mentee_ID = $_SESSION['user_ID'];
  $status = "Pending";

  $stmt = $connection->prepare("INSERT INTO mentorship (mentor_ID, mentee_ID, status) VALUES (?, ?, ?)");
  $stmt->bind_param("iis", $mentor_ID, $mentee_ID, $status);

  // Send a response back indicating the success or failure of the update operation
  if ($stmt->execute()) {
      echo "success";
      error_log("Success");
  } else {
      error_log($stmt->error);
      echo "failed";
  }

  $stmt->close();
?>
