<?php
	include("../connection.php");
	session_start();
		
	$exp_ID = $_POST['exp_ID'];
	
	$sql = "DELETE FROM experience WHERE exp_ID = '$exp_ID'";
	$result = mysqli_query($connection, $sql);
	
	// Check if the delete operation was successful
	if ($result) {
		echo "Experience deleted successfully!";
	} else {
		echo "Error deleting experience: " . mysqli_error($connection);
	}
?>
