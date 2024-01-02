<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("connection.php");
session_start();

$mentor_ID = $_POST['mentor_ID'];
$newStatus = $_POST['status'];
$invite_ID = $_POST['invite_ID'];

// Use prepared statement to prevent SQL injection
$sql = "UPDATE invitation SET status = ? WHERE invite_ID = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("si", $newStatus, $invite_ID);
$result = $stmt->execute();

if ($result) {
    // Creation for review purposes
    $query = "INSERT INTO mentorship (mentor_ID, mentee_ID, status) VALUE (?,?,?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("iii", $mentor_ID, $_SESSION["user_ID"], $newStatus);
    $stmt->execute();

    if ($stmt->error) {
        echo "Error: " . $stmt->error;
    } else {
        echo $invite_ID;
    }
} else {
    echo "Failed to save changes!";
}
?>
