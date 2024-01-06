<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("connection.php");
session_start();

// // Retrieve the form data
$club_ID = $_POST['clubID'];
$club_name = $_POST['clubName'];
$club_description = $_POST['description'];
$position_available = $_POST['position'];
$skill_needed = $_POST['skill'];
$notes = $_POST['notes'];

// Prepare SQL
$sql = "UPDATE club SET club_name=?, club_description=?, position_available=?, skill_needed=?, notes=? WHERE club_ID=?";
$stmt = $connection->prepare($sql);

$stmt->bind_param("ssssss", $club_name, $club_description, $position_available, $skill_needed, $notes, $club_ID);
// Check if the update was successful
if ($stmt->execute()) {
    echo "success";
} else {
    echo "Failed to edit.";
}

$stmt->close();
$connection->close();
?>
