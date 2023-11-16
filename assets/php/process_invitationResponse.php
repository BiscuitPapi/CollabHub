<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  include("connection.php");
  session_start();

  $studyhub_ID = $_POST['studyHub_ID'];
  $newStatus = $_POST['status'];

  // Perform the necessary database update operation to save the changes
  $sql = "UPDATE invitation SET status = '$newStatus' WHERE studyHub_ID = '$studyhub_ID' AND user_ID = '" . $_SESSION['user_ID'] . "'";
  $result = mysqli_query($connection, $sql);

  // If the update is successful, perform the insertion into studyhub_members
  if ($result && $newStatus == "Accepted") {
    // Insert into studyhub_members
    $insert_sql = "INSERT INTO studyhub_members (studyhub_ID, user_ID) VALUES ('$studyhub_ID', '" . $_SESSION['user_ID'] . "')";
    $insert_result = mysqli_query($connection, $insert_sql);

    if ($insert_result) {
      echo "Changes saved successfully and studyhub_members updated!";
    } else {
      echo "Changes saved successfully, but failed to update studyhub_members!";
    }
  } else {
    echo "Failed to save changes!";
  }
?>
