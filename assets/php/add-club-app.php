<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve the form data
    $club_name = $_POST['club_name'];
    $club_description = $_POST['club_description'];
    $position_available = $_POST['position_available'];
    $skill_needed = $_POST['skill_needed'];
    $registration_link = $_POST['registration_link'];
    $notes = $_POST['notes'];
    $application_date = date('Y-m-d H:i:s');
    $user_ID = $_SESSION["user_ID"];

    // Prepare SQL
    //$sql = "INSERT INTO experience (type, groupName, position, startDate, endDate, description, user_ID, duration) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $sql = "INSERT INTO `club-application`(`club_name`, `club_description`, `position_available`, `skill_needed`, `registration_link`,`notes`, `application_date`, `user_ID`) VALUES (?,?,?,?,?,?,?,?)";

    $stmt = $connection->prepare($sql);

    $stmt->bind_param("ssssssss", $club_name, $club_description, $position_available,  $skill_needed, $registration_link, $notes, $application_date, $user_ID);

    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        echo "Experience added successfully!";
        header("Location: ../../club-application.php");

    } else {
        echo "Failed to add experience.";
    }
}
?>