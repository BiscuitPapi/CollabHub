<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Retrieve the form data
    $application_ID = $_GET['application_ID'];
    $applicant_ID = $_SESSION['user_ID'];
    $status = "Pending";
    $date_applied = date('Y-m-d H:i:s');

    // Prepare SQL
    $sql = "INSERT INTO `group_applicant_status`(`application_ID`, `applicant_ID`, `status`, `date_applied`) VALUES (?,?,?,?)";
    

    $stmt = $connection->prepare($sql);

    $stmt->bind_param("ssss", $application_ID, $applicant_ID, $status, $date_applied);

    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
    
        echo "Applied successfully!";
            
        header("Location: ../../myApplication.php");
        exit(); // Stop further execution

    } else {
        echo "Failed to apply.";
    }

    

   
}
?>