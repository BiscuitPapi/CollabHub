<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Retrieve the application ID from the URL parameter
    $application_id = $_GET['application_ID'];

    // Prepare the SQL statement
    $sql = "DELETE FROM `clubApplication` WHERE application_ID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $application_id);

    // Execute the SQL statement
    $stmt->execute();

    // Check if the deletion was successful
    if ($stmt->affected_rows > 0) {
        echo "Club application deleted successfully!";
        header("Location: ../../myApplication.php");
    } else {
        echo "Failed to delete club application.";
    }

}
?>