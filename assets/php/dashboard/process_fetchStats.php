<?php
include("../connection.php");
session_start();

// Fetch user count
$query = "SELECT COUNT(*) AS user_count FROM user";
$stmt = $connection->prepare($query);
$stmt->execute();

if ($stmt->error) {
    echo "Error: " . $stmt->error;
} else {
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $userCount = $row['user_count']; // Access the count value using the alias
}

// Fetch studyhub count
$query_2 = "SELECT COUNT(*) AS sb_count FROM studyhub";
$stmt_2 = $connection->prepare($query_2);
$stmt_2->execute();

if ($stmt_2->error) {
    echo "Error: " . $stmt_2->error;
} else {
    $result_2 = $stmt_2->get_result();
    $row_2 = $result_2->fetch_assoc();
    $sbCount = $row_2['sb_count']; // Access the count value using the alias
}


// Fetch club count
$queryClub = "SELECT COUNT(*) AS club_count FROM club";
$stmtClub = $connection->prepare($queryClub);
$stmtClub->execute();

if ($stmtClub->error) {
    echo "Error: " . $stmtClub->error;
} else {
    $resultClub = $stmtClub->get_result();
    $rowClub = $resultClub->fetch_assoc();
    $clubCount = $rowClub['club_count']; // Access the count value using the alias
}

// Fetch group-application count
$queryGroupApp = "SELECT COUNT(*) AS group_app_count FROM `group-application`";
$stmtGroupApp = $connection->prepare($queryGroupApp);
$stmtGroupApp->execute();

if ($stmtGroupApp->error) {
    echo "Error: " . $stmtGroupApp->error;
} else {
    $resultGroupApp = $stmtGroupApp->get_result();
    $rowGroupApp = $resultGroupApp->fetch_assoc();
    $groupAppCount = $rowGroupApp['group_app_count']; // Access the count value using the alias
}



// Create a JSON object
$jsonObject = array(
    "user_count" => $userCount,
    "sb_count" => $sbCount,
    "club_count" => $clubCount,
    "group_count" => $groupAppCount
);



// Echo the JSON object
echo json_encode($jsonObject);
?>
