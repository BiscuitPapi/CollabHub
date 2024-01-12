<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Retrieve the form data
    $club_ID = $_GET['club_ID'];
    $applicant_ID = $_GET['applicant_ID'];
    $status = "Rejected";

    // Prepare SQL
    $sql = "UPDATE `clubApplication` SET `status`=? WHERE clubApplication_ID = ? AND applicant_ID = ?";    
    $stmt = $connection->prepare($sql);

    $stmt->bind_param("sss", $status, $application_ID, $applicant_ID);

    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
    
        echo "Applied successfully!";
        header("Location: ../../../public/club_application_view.php?application_ID=" . $application_ID);
        exit(); // Stop further execution

    } else {
        echo "Failed to apply.";
    }

    

   
}
?>