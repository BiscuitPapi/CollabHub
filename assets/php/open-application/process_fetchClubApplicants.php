<?php
include("../connection.php");
session_start();

$club_ID = $_POST['club_ID'];
$status = $_POST['status'];

$query = "SELECT u.user_ID, u.name, DATEDIFF(NOW(), c.date_created) AS days_since_creation, c.status, c.clubApplication_ID FROM user u JOIN clubApplication c on u.user_ID = c.applicant_ID WHERE c.club_ID = '$club_ID' AND c.status = ?";

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