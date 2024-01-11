
<?php
  include("../connection.php");
  
  $mt_ID = $_POST['mt_ID'];
  $newStatus = $_POST['status'];

  // Perform the necessary database update operation to save the changes
  $sql = "UPDATE mentorship SET status = '$newStatus' WHERE mt_ID = '$mt_ID'";
  $result = mysqli_query($connection, $sql);
  
  // Send a response back indicating the success or failure of the update operation
  if ($result) {
    echo "Changes saved successfully!";
  } else {
    echo "Failed to save changes!";
  }
?>