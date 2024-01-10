<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("connection.php");
session_start();

$mentor_ID = $_POST['mentor_ID'];
$newStatus = $_POST['status'];
$invite_ID = $_POST['invite_ID'];

// $mentor_ID = 1;
// $newStatus = "Accepted";
// $invite_ID = 13;

// Use prepared statement to prevent SQL injection
$sql = "UPDATE invitation SET status = ? WHERE invite_ID = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("si", $newStatus, $invite_ID);
$result = $stmt->execute();

if ($result) {
    // Creation for review purposes
    $query = "UPDATE mentorship SET status = ? WHERE mentor_ID = ? AND mentee_ID = ?";
    $stmt = $connection->prepare($query); // You used $sql here, but $query is the correct variable
    $stmt->bind_param("sii", $newStatus, $mentor_ID, $_SESSION["user_ID"]);
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
