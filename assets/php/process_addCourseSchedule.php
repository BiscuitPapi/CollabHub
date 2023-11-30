<?php
    include("connection.php");
    session_start();

    $user_ID = $_SESSION["user_ID"];
    $addedCourse = $_POST['addedCourse'];
    $addedDay = $_POST['addedDay'];
    $addedStartTime = $_POST['addedStartTime'];
    $addedEndTime = $_POST['addedEndTime'];
    
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
            echo "Schedule edited successfully!";
            header("Location: ../../schedule.php");
        } else {
            echo "Failed to edit schedule.";
        }
        // $newScheduleID = mysqli_insert_id($connection); // Retrieve the newApplicationID
        // echo "success|" . $newScheduleID; // Return success and the newApplicationID

    } else {
        echo "Error: " . $stmt->error; 
    }

    $stmt->close();
?>
