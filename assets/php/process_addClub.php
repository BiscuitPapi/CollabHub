<?php
    include("connection.php");
    session_start();

    $user_ID = $_SESSION["user_ID"];
    $addedClubName = $_POST['addedClubName'];
    $addedClubDescription = $_POST['addedClubDescription'];
    $addedClubPosition = $_POST['addedClubPosition'];
    $addedClubSkills = $_POST['addedClubSkills'];
    $addedClubNotes = $_POST['addedClubNotes'];
    $application_date = date('Y-m-d H:i:s');

    $sql = "INSERT INTO `club-application`(`club_name`, `club_description`, `position_available`, `skill_needed`, `notes`, `application_date`, `user_ID`) VALUES (?,?,?,?,?,?,?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssssi", $addedClubName, $addedClubDescription, $addedClubPosition, $addedClubSkills, $addedClubNotes, $application_date, $user_ID);

    if ($stmt->execute()) {
        $newApplicationID = mysqli_insert_id($connection); // Retrieve the newApplicationID
        echo "success|" . $newApplicationID; // Return success and the newApplicationID
    } else {
        echo "error";
    }

    $stmt->close();
?>
