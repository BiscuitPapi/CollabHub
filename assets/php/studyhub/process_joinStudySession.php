<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../connection.php");
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Retrieve the form data
    $studysession_id = $_GET['studysession_id'];
    $user_ID = $_SESSION['user_ID'];

    // Prepare SQL
    //$sql = "INSERT INTO experience (type, groupName, position, startDate, endDate, description, user_ID, duration) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    echo $studysession_id;
    echo $user_ID;

    $sql = "INSERT INTO `studysession_member`(`studysession_id`, `user_ID`) VALUES (?,?)";

    $stmt = $connection->prepare($sql);

    $stmt->bind_param("ss", $studysession_id, $user_ID);

    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        echo "Experience added successfully!";
        header("Location: ../../view-session.php?studysession_id=" . $studysession_id);

    } else {
        echo "Failed to join the study session.";
    }
}
?>