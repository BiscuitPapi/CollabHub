<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve the form data
    $studyhub_ID = $_POST['studyhub_ID'];
    $studysession_name = $_POST['studysession_name'];
    $studysession_date = $_POST['studysession_date'];
    $studysession_time = $_POST['studysession_time'];
    $studysession_mode = $_POST['studysession_mode'];
    $studysession_link = $_POST['studysession_link'];
    $note = $_POST['note'];
    $created_on = date('Y-m-d H:i:s');
    $created_by = $_SESSION["user_ID"];

    // Prepare SQL
    $sql = "INSERT INTO `study_session`(`studyhub_ID`, `studysession_name`, `studysession_date`, `studysession_time`, `studysession_mode`, `studysession_link`, `note`, `created_on`, `created_by`) VALUES (?,?,?,?,?,?,?,?,?)";
    
    $stmt = $connection->prepare($sql);

    $stmt->bind_param("issssssss", $studyhub_ID, $studysession_name, $studysession_date, $studysession_time, $studysession_mode, $studysession_link, $note, $created_on, $created_by);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {

            // Get the ID of the newly inserted studysession
            $studysession_id = $stmt->insert_id; 

            $sql2 = "INSERT INTO `studysession_member`(`studysession_id`, `user_ID`) VALUES (?, ?)";

            $stmt2 = $connection->prepare($sql2);

            $stmt2->bind_param("ii", $studysession_id,$created_by);

            $stmt2->execute();

            if ($stmt2->affected_rows > 0) {
                echo "Studyhub added successfully!";
                
                header("Location: ../../studyhub-profile.php?studyhub_ID=" . $studyhub_ID);
                exit(); // Stop further execution
                
            } else {
                echo "Failed to add study hub members.";
            }

        } else {
            echo "Failed to add study session. No rows affected.";
        }
    } else {
        echo "Error executing the SQL statement: " . $stmt->error;
    }

   

   
}
?>

// $stmt->execute();

// // Check if the insertion was successful
// if ($stmt->affected_rows > 0) {
//     echo "Study session added successfully!";
    
//     header("Location: ../../studyhub-profile.php?studyhub_ID=" . $studyhub_ID);
//     exit(); // Stop further execution
    
// } else {
//     echo "Failed to add study session.";
// }

