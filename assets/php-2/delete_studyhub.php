<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Retrieve the studyhub ID from the URL parameter
    $studyhub_ID = $_GET['studyhub_ID'];

    // Prepare the SQL statement
    $sql = "DELETE FROM `studyhub` WHERE studyhub_ID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $studyhub_ID);

    

    // Execute the SQL statement
    $stmt->execute();

    // Check if the deletion was successful
    if ($stmt->affected_rows > 0) {
        echo "Studyhub deleted successfully!";

        $sql2 = "DELETE FROM `studyhub_members` WHERE studyhub_ID = ?";
        $stmt2 = $connection->prepare($sql2);
        $stmt2->bind_param("s", $studyhub_ID);

        $stmt2->execute();
        if ($stmt2->affected_rows > 0) {

            echo "Studyhub deleted in studyhub_members successfully!";
            header("Location: ../../myStudyhub.php");
        }
        else {
            echo "Failed to delete studyhub in studyhub_members.";
        }

        
    } else {
        echo "Failed to delete studyhub.";
    }

}
?>