<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve the form data
    $studyhub_name = $_POST['studyhub_name'];
    $studyhub_description = $_POST['studyhub_description'];
    $setting = $_POST['setting'];
    $date_created = date('Y-m-d H:i:s');
    $user_ID = $_SESSION["user_ID"];

    // Prepare SQL
    $sql = "INSERT INTO `studyhub`(`studyhub_name`, `studyhub_description`, `setting`, `date_created`, `user_ID`) VALUES (?,?,?,?,?)";
    

    $stmt = $connection->prepare($sql);

    $stmt->bind_param("sssss", $studyhub_name, $studyhub_description, $setting, $date_created, $user_ID);

    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
    
        // Get the ID of the newly inserted studyhub
        $studyhub_ID = $stmt->insert_id; 

        // Update studyhub member lists
        $sql2 = "INSERT INTO `studyhub_members`(`studyhub_ID`, `user_ID`) VALUES (?,?)";

        $stmt2 = $connection->prepare($sql2);

        $stmt2->bind_param("ss", $studyhub_ID,$user_ID);

        $stmt2->execute();

        if ($stmt2->affected_rows > 0) {
            echo "Studyhub added successfully!";
            
            header("Location: ../../studyhub-profile.php?studyhub_ID=" . $studyhub_ID);
            exit(); // Stop further execution
            
        } else {
            echo "Failed to add study hub members.";
        }

    } else {
        echo "Failed to create study hub.";
    }

    

   
}
?>