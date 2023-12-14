<?php
  include("connection.php");
  session_start();

  $studyhub_ID = $_POST['studyhub_ID'];
  $user_ID = $_SESSION['user_ID'];

  $stmt = $connection->prepare("INSERT INTO studyhub_members (studyhub_ID, user_ID) VALUES (?, ?)");
  $stmt->bind_param("ii", $studyhub_ID, $user_ID);

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
