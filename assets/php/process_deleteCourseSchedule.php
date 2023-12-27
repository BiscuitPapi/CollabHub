<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Retrieve the schedule ID from the URL parameter
    $schedule_ID = $_GET['schedule_ID'];

    // Prepare the SQL statement
    $sql = "DELETE FROM `schedule` WHERE schedule_ID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $schedule_ID);

    // Execute the SQL statement
    $stmt->execute();

    // Check if the deletion was successful
    if ($stmt->affected_rows > 0) {
        header("Location: ../../editProfile.php");
    } else {
        echo "Failed to delete course schedule.";
    }

}
?>