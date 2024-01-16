<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $application_ID = $_POST['group_ID'];
    $projectName = $_POST['projectName'];
    $projectDesc = $_POST['projectDesc'];
    $projectSkills = $_POST['projectSkills'];
    $projectNotes = $_POST['projectNotes'];

    $sql = "UPDATE `group-application` SET `project_name`= ?, `project_description`= ?, `skill_needed`= ?, `notes`= ? WHERE application_id = ?;";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssi", $projectName, $projectDesc, $projectSkills, $projectNotes, $application_ID);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "success";
    }

    else{
        echo "Error saving changes";
    }


}
?>