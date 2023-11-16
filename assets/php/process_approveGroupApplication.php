<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Retrieve the form data
    $application_ID = $_GET['application_ID'];
    $applicant_ID = $_GET['applicant_ID'];
    $status = "approved";

    // Prepare SQL
    $sql = "UPDATE `group_applicant_status` SET `status`=? WHERE application_ID = ? AND applicant_ID = ?";    
    $stmt = $connection->prepare($sql);

    $stmt->bind_param("sss", $status, $application_ID, $applicant_ID);

    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
    
        echo "Applied successfully!";
        header("Location: ../../group_application_view.php?application_ID=" . $application_ID);
        exit(); // Stop further execution

    } else {
        echo "Applied successfully.";
    }

    

   
}
?>