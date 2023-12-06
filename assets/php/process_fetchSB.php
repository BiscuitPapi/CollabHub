<?php
include("connection.php");

$limit = 10; // Number of entries per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

$offset = ($page - 1) * $limit; // Offset for pagination

$query = "SELECT sh.*, u.name AS creator_name, COUNT(sm.user_ID) AS member_count
          FROM studyhub sh
          JOIN user u ON sh.user_ID = u.user_ID
          LEFT JOIN studyhub_members sm ON sh.studyhub_ID = sm.studyhub_ID
          GROUP BY sh.studyhub_ID
          LIMIT ? OFFSET ?";

$stmt = $connection->prepare($query);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

$count = $offset + 1; // Initialize count variable

$rows = array();

while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

$stmt->close();

// Close the database connection
mysqli_close($connection);

echo json_encode($rows);
?>
