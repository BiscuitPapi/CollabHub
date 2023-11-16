<?php
	include("connection.php");
	session_start();
	
	$addedName = $_POST['addedName'];
	$addedType = $_POST['addedType'];
	$user_ID = $_SESSION["user_ID"];
	
	
	$stmt = $connection->prepare("INSERT INTO badge (name, type, user_ID) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $addedName, $addedType, $user_ID);
  
	// Send a response back indicating the success or failure of the update operation
	if ($stmt->execute()) {
        echo "Badge added successfully!";
    } else {
        error_log("Error adding badge: " . $stmt->error);
        echo "Error adding badge.";
    }
	
	
	$stmt->close();
?>
