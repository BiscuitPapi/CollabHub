<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve the form data
    $application_id = $_GET['application_ID'];
    //$department_name = $_POST['department_name'];
   // $course_name = $_POST['course_name'];
    $project_name = $_POST['project_name'];
    $project_description = $_POST['project_description'];
    $skill_needed = $_POST['skill_needed'];
    $notes = $_POST['notes'];


    // Prepare SQL


    $sql = "UPDATE `group-application` SET `project_name`= ?, `project_description`= ?, `skill_needed`= ?, `notes`= ? WHERE application_id = ?;";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssss", $project_name, $project_description, $skill_needed, $notes, $application_id);
    $stmt->execute();

    

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        echo "Group application edited added successfully!";
        header("Location: ../../../public/group_application_view.php?application_ID=" . $application_id);

    } else {
        echo "Failed to edit group application.";
        
    }

    

    
}
?>