<?php
include("connection.php");
session_start();
$query = "SELECT *, DATEDIFF(NOW(), application_date) AS days_since_creation FROM club WHERE user_ID != ?";

$stmt = $connection->prepare($query);
$stmt->bind_param("i", $_SESSION["user_ID"]);
$stmt->execute();
$result = $stmt->get_result();

$rows = array();

while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

$stmt->close();

// Close the database connection
mysqli_close($connection);

echo json_encode($rows);
?>
