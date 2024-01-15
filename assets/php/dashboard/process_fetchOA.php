<?php
include("../connection.php");
session_start();


$query = "SELECT DISTINCT club_ID FROM clubApplication WHERE applicant_ID = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $_SESSION["user_ID"]);
$stmt->execute();
$result = $stmt->get_result();

// Initialize an empty array to store the results
$clubIDs = array();

// Fetch each row and add the club_ID to the array
while ($row = $result->fetch_assoc()) {
    $clubIDs[] = $row['club_ID'];
}

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

$filteredArray = array_filter($rows, function ($element) use ($clubIDs) {
    return !in_array($element['club_ID'], $clubIDs);
});

// Reindex the array to remove any gaps in the keys
$filteredArray = array_values($filteredArray);

// echo '<pre>';
// print_r($filteredArray);
// echo '</pre>';

echo json_encode($filteredArray);
?>
