<?php
	include("connection.php");
	session_start();
	
	$newListing = $_POST['remainingValues'];
	$user_ID = $_SESSION["user_ID"];

	// Update the subjects in the database
	$stmt = $connection->prepare("UPDATE user SET subjects = ? WHERE user_ID = ?");
	$stmt->bind_param("si", $newListing, $user_ID);

	// Send a response back indicating the success or failure of the update operation
	if ($stmt->execute()) {
		echo "Changes have been saved";
	} else {
		error_log("Error" . $stmt->error);
		echo "Error";
	}
	
	$stmt->close();
?>
