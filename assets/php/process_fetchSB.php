<?php
include("connection.php");
session_start();

$query = "SELECT sh.*, u.name AS creator_name, 
COUNT(sm.studyhub_ID) AS member_count
FROM studyhub sh
JOIN user u ON sh.user_ID = u.user_ID
LEFT JOIN studyhub_members sm ON sh.studyhub_ID = sm.studyhub_ID
WHERE sh.user_ID <> ?
GROUP BY sh.studyhub_ID
";

// Store the session variable in a separate variable
$userID = (int)$_SESSION["user_ID"];

$stmt = $connection->prepare($query);
$stmt->bind_param("i", $userID);
$stmt->execute();


if ($stmt->error) {
    echo "Error: " . $stmt->error;
} else {
    $result = $stmt->get_result();

    $rows = array();

    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    $stmt->close();

    // Close the database connection
    mysqli_close($connection);

    echo json_encode($rows);
}


?>
