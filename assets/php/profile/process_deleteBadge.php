<?php
	include("../connection.php");
	session_start();
		
	$badgeID = $_POST['badgeID'];
	
	$sql = "DELETE FROM badge WHERE badge_ID = '$badgeID'";
	$result = mysqli_query($connection, $sql);
	
	// Check if the delete operation was successful
	if ($result) {
		echo "Badge deleted successfully!";
	} else {
		echo "Error deleting badge: " . mysqli_error($connection);
	}
?>
