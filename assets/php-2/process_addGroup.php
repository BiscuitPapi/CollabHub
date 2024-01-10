<?php
    include("connection.php");
    session_start();

    $user_ID = $_SESSION["user_ID"];
    $addedDepartment = $_POST['addedDepartment'];
    $addedCourse = $_POST['addedCourse'];
    $addedName = $_POST['addedName'];
    $addedDescription = $_POST['addedDescription'];
    $addedSkills = $_POST['addedSkills'];
    $addedNotes = $_POST['addedNotes'];
    $application_date = date('Y-m-d H:i:s');
    $user_ID = $_SESSION["user_ID"];
    
    $sql = "INSERT INTO `group-application`(`department_name`, `course_name`, `project_name`, `project_description`, `skill_needed`, `notes`, `application_date`, `user_ID`) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssssi", $addedDepartment, $addedCourse, $addedName, $addedDescription, $addedSkills, $addedNotes, $application_date, $user_ID);

    if ($stmt->execute()) {
        $newApplicationID = mysqli_insert_id($connection); // Retrieve the newApplicationID
        echo "success|" . $newApplicationID; // Return success and the newApplicationID
    } else {
        echo "error";
    }

    $stmt->close();
?>
