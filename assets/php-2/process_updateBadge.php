<?php
	include("connection.php");
	session_start();
	
	$badge_ID = $_POST['badge_ID'];
	$badgeName = $_POST['badgeName'];
  
	// Perform the necessary database update operation to save the changes
	$sql = "UPDATE badge SET name = '$badgeName' WHERE badge_ID = '$badge_ID'";
	$result = mysqli_query($connection, $sql);
  
	// Send a response back indicating the success or failure of the update operation
	if ($result) {
		echo "Changes saved successfully!";
	} else {
		echo "Failed to save changes!";
	}
?>
