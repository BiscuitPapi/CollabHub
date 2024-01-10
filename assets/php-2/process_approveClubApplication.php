<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
session_start();

// Retrieve the form data
$clubApplication_ID = $_POST['clubApplication_ID'];
$newStatus = $_POST['status'];

// Prepare SQL
$sql = "UPDATE clubApplication SET status = ? WHERE clubApplication_ID = ?";
$stmt = $connection->prepare($sql);

$stmt->bind_param("si", $newStatus, $clubApplication_ID);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "Failed to edit.";
}

?>