<?php
include("../connection.php");
session_start();

$studyHub_ID = $_POST['studyHub_ID'];
$user_ID = $_POST['user_ID'];
$type = $_POST['type'];

if ($studyHub_ID == "") {
    $studyHub_ID = $_SESSION["user_ID"];
}
// Correct the SQL syntax - should use VALUES() with INSERT INTO
$sql = "INSERT INTO invitation (type, studyHub_ID, user_ID) VALUES (?, ?, ?)";
$stmt = $connection->prepare($sql);

// Add the missing placeholder for $type in bind_param
$stmt->bind_param("sii", $type, $studyHub_ID, $user_ID);

$status = "Waiting";

if ($stmt->execute()) {
    if ($type == "Mentorship") {
        // Use prepared statements for the second SQL query
        $mentorshipSql = "INSERT INTO mentorship (mentor_ID, mentee_ID, status) VALUES (?, ?, ?)";
        $mentorshipStmt = $connection->prepare($mentorshipSql);
        $mentorshipStmt->bind_param("iis", $_SESSION["user_ID"], $user_ID, $status);

        if ($mentorshipStmt->execute()) {
            echo "success";
        } else {
            echo "error: " . $mentorshipStmt->error;
        }

        $mentorshipStmt->close();
    } else {
        echo "success";
    }
} else {
    echo "error: " . $stmt->error;
}

$stmt->close();
?>