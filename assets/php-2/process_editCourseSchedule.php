<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_ID = $_SESSION["user_ID"];
    $schedule_ID = isset($_POST['scheduleID']) ? $_POST['scheduleID'] : '';
    $course_name = isset($_POST['editedCourseName']) ? $_POST['editedCourseName'] : '';
    $day = isset($_POST['editedDay']) ? $_POST['editedDay'] : '';
    $start_time = isset($_POST['editedStartTime']) ? $_POST['editedStartTime'] : '';
    $end_time = isset($_POST['editedEndTime']) ? $_POST['editedEndTime'] : '';

    // Check if any of the required variables is empty
    if (empty($schedule_ID) || empty($course_name) || empty($day) || empty($start_time) || empty($end_time)) {
        echo "One or more required fields are empty. Please fill in all fields.";
        exit; // Stop further execution
    }

    // Convert time strings to timestamps
    $startTime = strtotime($start_time);
    $endTime = strtotime($end_time);

    // Calculate the duration in seconds
    $duration = ($endTime - $startTime) / 3600; // Calculate hours

    // Prepare the SQL statement
    $sql = "UPDATE schedule SET course_name = ?, day = ?, start_time = ?, end_time = ?, duration = ? WHERE schedule_ID = ?";
    $stmt = $connection->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssssii", $course_name, $day, $start_time, $end_time, $duration, $schedule_ID);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Schedule updated successfully.";

        // Close the statement
        $stmt->close();
    } else {
        echo "Error updating schedule information: " . $connection->error;
    }

}
?>