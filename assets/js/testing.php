<?php
    include("../php/connection.php");
    error_log("testing.php is running");

    session_start();
	// User ID from the session
	$userID = $_SESSION["user_ID"];
    $addedSubject = $_POST['addedSubject'];

    // Prepare the SQL statement to retrieve the current subjects
    $retrieveStmt = $connection->prepare("SELECT subjects FROM user WHERE user_ID = ?");
    
    // Check if the retrieval statement was prepared successfully
    if ($retrieveStmt) {
        // Bind the user ID parameter and execute the retrieval statement
        $retrieveStmt->bind_param("i", $userID);
        
        if ($retrieveStmt->execute()) {
            $result = $retrieveStmt->get_result();
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $existingSubjects = $row['subjects'];

                // Update the subjects by adding the new subject
                if (empty($existingSubjects)) {
                    $newSubjects = $addedSubject;
                } else {
                    $newSubjects = $existingSubjects . ", " . $addedSubject;
                }

                $updateStmt = $connection->prepare("UPDATE user SET subjects = ? WHERE user_ID = ?");
                
                // Check if the update statement was prepared successfully
                if ($updateStmt) {
                    // Bind the parameters and execute the update statement
                    $updateStmt->bind_param("si", $newSubjects, $userID);
                    
                    if ($updateStmt->execute()) {
                        echo "Update successful. Updated subjects: " . $newSubjects;
                    } else {
                        echo "Update failed: " . $updateStmt->error;
                    }

                    // Close the update statement
                    $updateStmt->close();
                } else {
                    echo "Preparation of the update statement failed: " . $connection->error;
                }
            } else {
                echo "User not found or multiple users with the same ID.";
            }
        } else {
            echo "Retrieval statement execution failed: " . $retrieveStmt->error;
        }

        // Close the retrieval statement
        $retrieveStmt->close();
    } else {
        echo "Preparation of the retrieval statement failed: " . $connection->error;
    }

    // Close the database connection
    $connection->close();
?>
