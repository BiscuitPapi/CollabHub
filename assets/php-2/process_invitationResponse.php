<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("connection.php");
session_start();

$studyhub_ID = $_POST['studyHub_ID'];
$newStatus = $_POST['status'];

// Use prepared statement to prevent SQL injection
$sql = "UPDATE invitation SET status = ? WHERE studyHub_ID = ? AND user_ID = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("sii", $newStatus, $studyhub_ID, $_SESSION['user_ID']);
$result = $stmt->execute();

if ($result) {
    // Creation for review purposes
    $query = "SELECT user_ID FROM studyhubMember WHERE studyhub_ID = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $studyhub_ID);
    $stmt->execute();

    if ($stmt->error) {
        echo "Error: " . $stmt->error;
    } else {
        $result = $stmt->get_result();

        // Inside the while loop for fetching studyhub_members
        while ($row = $result->fetch_assoc()) {
            $reviewee = $row['user_ID'];
            $reviewer = $_SESSION["user_ID"];

            // Insert feedback record for the original reviewer reviewing the original reviewee
            $insertQuery1 = "INSERT INTO feedback (reviewer, reviewee) VALUES (?, ?)";
            $insertStmt1 = $connection->prepare($insertQuery1);
            $insertStmt1->bind_param("ii", $reviewer, $reviewee);
            $insertStmt1->execute();

            // Insert feedback record for the original reviewee reviewing the original reviewer
            $insertQuery2 = "INSERT INTO feedback (reviewer, reviewee) VALUES (?, ?)";
            $insertStmt2 = $connection->prepare($insertQuery2);
            $insertStmt2->bind_param("ii", $reviewee, $reviewer);
            $insertStmt2->execute();

            // Check for errors during feedback insertions
            if ($insertStmt1->error || $insertStmt2->error) {
                echo "Error inserting feedback: " . $insertStmt1->error . " | " . $insertStmt2->error;
            } else {
                // Insert into studyhub_members
                $insert_sql = "INSERT INTO studyhubMember (studyhub_ID, user_ID) VALUES (?, ?)";
                $insert_stmt = $connection->prepare($insert_sql);
                $insert_stmt->bind_param("is", $studyhub_ID, $_SESSION['user_ID']);
                $insert_result = $insert_stmt->execute();

                // Provide feedback based on the result of the studyhub_members insertion
                if ($insert_result) {
                    echo "Changes saved successfully and studyhub_members updated!";
                } else {
                    echo "Changes saved successfully, but failed to update studyhub_members!";
                }
            }

            // Close prepared statements for feedback insertions
            $insertStmt1->close();
            $insertStmt2->close();
            $insert_stmt->close();
        }

        $stmt->close();
    }
} else {
    echo "Failed to save changes!";
}
?>
