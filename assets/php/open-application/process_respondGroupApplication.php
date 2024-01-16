<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../connection.php");
session_start();

// Retrieve the form data
$groupApplication_ID = $_POST['groupApplication_ID'];
$newStatus = $_POST['status'];
$applicant_ID = $_POST['applicant_ID'];

// Prepare SQL
$sql = "UPDATE `group_applicant_status` SET `status`=? WHERE application_ID = ? AND applicant_ID = ?";    
$stmt = $connection->prepare($sql);

if (!$stmt) {
    die("Error in statement preparation: " . $connection->error);
}

$stmt->bind_param("sii", $newStatus, $groupApplication_ID, $applicant_ID);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "Failed to edit: " . $stmt->error;
}

$stmt->close();
$connection->close();
?>
