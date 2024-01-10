<?php
    include("../connection.php");
    session_start();

    $user_ID = $_SESSION["user_ID"];
    $addedCourse = $_POST['courseName'];
    $addedDay = $_POST['day'];
    $addedStartTime = $_POST['startTime'];
    $addedEndTime = $_POST['endTime'];
    
    // Convert time strings to timestamps
    $startTime = strtotime($addedStartTime);
    $endTime = strtotime($addedEndTime);

    // Calculate the duration in seconds
    $duration = ($endTime - $startTime)/60/60;

    $sql = "INSERT INTO `schedule`(`course_name`, `day`, `start_time`, `end_time`, `duration`, `user_ID`) VALUES (?,?,?,?,?,?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssi" , $addedCourse, $addedDay, $addedStartTime, $addedEndTime, $duration, $user_ID);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "A new schedule has been added!";
        } else {
            echo "Failed to edit schedule.";
        }
    
    } else {
        echo "Error: " . $stmt->error; 
    }

    $stmt->close();
?>
