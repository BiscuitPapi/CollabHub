<?php
    include("connection.php");
    session_start();
    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

    $studyHubName = $_POST['studyHubName'];
    $studyHubDescription = $_POST['studyHubDescription'];
    $studyHub_ID = $_POST['studyHub_ID'];
    $selectedSetting = $_POST['selectedSetting'];
   

    // Prepare the SQL query for updating the studyhub record
    $stmt = $connection->prepare("UPDATE studyhub SET studyhub_name = ?, studyhub_description = ?, setting = ? WHERE studyhub_ID = ?");
    $stmt->bind_param("sssi", $studyHubName, $studyHubDescription, $selectedSetting, $studyHub_ID);

    // Send a response back indicating the success or failure of the update operation
    if ($stmt->execute()) {
        echo "success";
    } else {
        error_log("Error updating information " . $stmt->error);
        echo "failed";
    }

    $stmt->close();
?>
