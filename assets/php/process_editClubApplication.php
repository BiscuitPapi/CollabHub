<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve the form data
    $application_id = $_GET['application_ID'];
    $club_name = $_POST['club_name'];
    $club_description = $_POST['club_description'];
    $position_available = $_POST['position_available'];
    $skill_needed = $_POST['skill_needed'];
    $notes = $_POST['notes'];

    // Prepare SQL
    $sql = "UPDATE `club-application` SET `club_name`= ?, `club_description`= ?, `position_available`=?, `skill_needed`= ?, `notes`= ? WHERE application_id = ?;";

    $stmt = $connection->prepare($sql);

    $stmt->bind_param("ssssss", $club_name, $club_description, $position_available,  $skill_needed, $notes, $application_id);

    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        echo "Club editted successfully!";
        header("Location: ../../club_application_view.php?application_ID=" . $application_id);

    } else {
        echo "Failed to add experience.";
    }
}
?>