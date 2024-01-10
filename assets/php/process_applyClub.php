<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
session_start();

// Retrieve the form data
$club_ID = $_POST['club_ID'];

// Prepare SQL
$sql = "INSERT INTO clubApplication (club_ID, applicant_ID) VALUES (?,?)";
$stmt = $connection->prepare($sql);

$stmt->bind_param("si", $club_ID, $_SESSION["user_ID"]);

if ($stmt->execute()) {
    echo "success";
    // Redirect to the previous page on success
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    echo "Failed to edit.";
}

?>