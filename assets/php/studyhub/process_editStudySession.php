<?php
    include("../connection.php");
    session_start();
    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve the form data
        $user_ID = $_SESSION["user_ID"];
        $studysession_id = $_GET['studysession_id'];
        $studysession_name = $_POST['studysession_name'];
        $studysession_time = $_POST['studysession_time'];
        $studysession_mode = $_POST['studysession_mode'];
        $studysession_link = $_POST['studysession_link'];
        $studysession_date = $_POST['studysession_date'];
        $note = $_POST['note'];
        

        // Prepare SQL
        $sql = "UPDATE `study_session` SET `studysession_name`= ?, `studysession_date`= ?, `studysession_time`= ?, `studysession_mode`= ?, `studysession_link`= ?, `note` = ? WHERE `studysession_id`= ?";
        
        $stmt = $connection->prepare($sql);

        // Check if the prepare statement was successful
        if ($stmt) {
            $stmt->bind_param("ssssssi", $studysession_name, $studysession_date, $studysession_time, $studysession_mode, $studysession_link, $note, $studysession_id);

            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo "Schedule edited successfully!";
                    header("Location: ../../../public/view-session.php?studysession_id=" . $studysession_id);
                } else {
                    echo "Failed to edit study session.";
                }
            } else {
                echo "Error: " . $stmt->error; 
            }

            $stmt->close();
        } else {
            echo "Failed to prepare the SQL statement.";
        }
    }
?>
