<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Validate and sanitize the application_ID from the URL
    if (isset($_GET['application_ID']) && is_numeric($_GET['application_ID'])) {
        $application_ID = intval($_GET['application_ID']);
    } else {
        echo "Invalid or missing application_ID.";
        exit(); // Stop further execution
    }

    // The rest of your code remains the same
    $applicant_ID = $_SESSION['user_ID'];
    $status = "Pending";
    $date_applied = date('Y-m-d H:i:s');

    $sql = "INSERT INTO `club_applicant_status`(`application_ID`, `applicant_ID`, `status`, `date_applied`) VALUES (?,?,?,?)";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("iiss", $application_ID, $applicant_ID, $status, $date_applied);

    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        echo "Applied successfully!";
        header("Location: ../../myApplication.php");
        exit(); // Stop further execution
    } else {
        echo "Failed to apply.";
    }
}

?>