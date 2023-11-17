<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_ID = $_SESSION["user_ID"];
    $schedule_ID = $_GET['schedule_ID'];
    $course_name = $_POST['course_name'];
    $day = $_POST['day'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    
    // Convert time strings to timestamps
    $startTime = strtotime($start_time);
    $endTime = strtotime($end_time);

    // Calculate the duration in seconds
    $duration = ($endTime - $startTime) / 3600; // Calculate hours

    // Prepare SQL
    $sql = "UPDATE `schedule` SET `course_name`= ?, `day`= ?, `start_time`= ?, `end_time`= ?, `duration`= ? WHERE `schedule_ID`= ?";
    
    $stmt = $connection->prepare($sql);

    // Check if the prepare statement was successful
    if ($stmt) {
        $stmt->bind_param("ssssii", $course_name, $day, $start_time, $end_time, $duration, $schedule_ID);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "Schedule edited successfully!";
                header("Location: ../../schedule.php");
            } else {
                echo "Failed to edit schedule.";
            }
        } else {
            echo "Error: " . $stmt->error; 
        }

        $stmt->close();
    } else {
        echo "Failed to prepare the SQL statement.";
    }
}
?>