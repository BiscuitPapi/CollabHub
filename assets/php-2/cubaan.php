<?php
	include("connection.php");
	session_start();
	
	$addedName = $_POST['addedName'];
	$user_ID = $_SESSION["user_ID"];

	// Retrieve the current subjects value from the database
	$stmt = $connection->prepare("SELECT subjects FROM user WHERE user_ID = ?");
	$stmt->bind_param("i", $user_ID);
	$stmt->execute();
	$stmt->bind_result($currentSubjects);
	$stmt->fetch();
	$stmt->close();

	// Define a custom separator
	$separator = "###"; // Choose a unique sequence unlikely to be in user input

	// Calculate the new subjects value by adding $addedName to the current value
	if (empty($currentSubjects)) {
		$newSubjects = $addedName;
	} else {
		$newSubjects = $currentSubjects . $separator . $addedName;
	}

	// Replace the custom separator with a comma and space when displaying the subjects
	$newSubjectsForDisplay = str_replace($separator, ', ', $newSubjects);

	// Update the subjects in the database
	$stmt = $connection->prepare("UPDATE user SET subjects = ? WHERE user_ID = ?");
	$stmt->bind_param("si", $newSubjects, $user_ID);

	// Send a response back indicating the success or failure of the update operation
	if ($stmt->execute()) {
		echo "success";
	} else {
		error_log("Error adding badge: " . $stmt->error);
		echo "Error adding badge.";
	}
	
	$stmt->close();
?>
