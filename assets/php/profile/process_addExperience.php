<?php
include("../connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST["input1"];
    $groupName = $_POST["input2"];
    $position = $_POST["input3"];
    $startDate = $_POST["input4"];
    $endDate = $_POST["input5"];
    $description = $_POST["input6"];
    $user_ID = $_SESSION['user_ID'];

    $date1 = new DateTime($startDate);
    $date2 = new DateTime($endDate);

    // Check if start date is greater than end date
    if ($date1 > $date2) {
        echo "Start date cannot be greater than end date.";
        exit;
    }

    $interval = $date1->diff($date2);
    $years = $interval->y;
    $months = $interval->m;
    $days = $interval->d;

    $duration = '';

    if ($years != 0) {
        $duration .= $years . ' years, ';
    }

    if ($months != 0) {
        $duration .= $months . ' months, ';
    }

    if ($days != 0) {
        $duration .= $days . ' days';
    }

    // Remove the final comma and space, if present
    $duration = rtrim($duration, ', ');

    $sql = "INSERT INTO experience (type, groupName, position, startDate, endDate, description, user_ID, duration) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssssss", $type, $groupName, $position, $startDate, $endDate, $description, $user_ID, $duration);

    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        echo "success";
    } else {
        echo "Failed to add experience.";
    }
}
?>
