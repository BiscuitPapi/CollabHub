<?php
include("../connection.php");
session_start();

$application_id = $_POST['application_ID'];
$status = $_POST['status'];

// $application_id = 30;
// $status = "Pending";
$query = "SELECT u.name, u.user_ID, gas.status, gas.application_ID, gas.applicant_ID, DATEDIFF(NOW(), gas.date_applied) AS days_since_creation
FROM user u JOIN group_applicant_status gas ON u.user_ID = gas.applicant_ID
WHERE gas.application_ID = '$application_id' AND gas.status = ?;";

$stmt = $connection->prepare($query);
$stmt->bind_param("s", $status);
$stmt->execute();
$result = $stmt->get_result();

$rows = array();

while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

$stmt->close();
echo json_encode($rows);
// echo '<pre>';
// print_r($rows);
// echo '</pre>';