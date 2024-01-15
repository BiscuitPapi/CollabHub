<?php
include("../connection.php");
session_start();
if (isset($_POST['type'])) {
    $criteria = $_POST['type'];
    if($criteria == "sortDate"){
        $query = "SELECT *, DATEDIFF(NOW(), application_date) AS days_since_creation FROM `group-application` WHERE user_ID != ? ORDER BY application_date ASC";
    }  

    else if($criteria == "sortCourse"){
        $query = "SELECT *, DATEDIFF(NOW(), application_date) AS days_since_creation FROM `group-application` WHERE user_ID != ? ORDER BY course_name ASC";
    }  

    else if($criteria == "sortDepartment"){
        $query = "SELECT *, DATEDIFF(NOW(), application_date) AS days_since_creation FROM `group-application` WHERE user_ID != ? ORDER BY department_name ASC";
    }  

    else if($criteria == "sortProject"){
        $query = "SELECT *, DATEDIFF(NOW(), application_date) AS days_since_creation FROM `group-application` WHERE user_ID != ? ORDER BY project_name ASC";
    }  
}
else{
    $query = "SELECT *, DATEDIFF(NOW(), application_date) AS days_since_creation FROM `group-application` WHERE user_ID != ? ORDER BY application_date DESC";
}

$stmt = $connection->prepare($query);
$stmt->bind_param("i", $_SESSION["user_ID"]);
$stmt->execute();
$result = $stmt->get_result();

$rows = array();

while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

$stmt->close();

// // Close the database connection
// mysqli_close($connection);
$query = "SELECT DISTINCT application_id FROM `group_applicant_status` WHERE applicant_ID = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $_SESSION["user_ID"]);
$stmt->execute();
$result = $stmt->get_result();

// Initialize an empty array to store the results
$groupIDs = array();

// Fetch each row and add the club_ID to the array
while ($row = $result->fetch_assoc()) {
    $groupIDs[] = $row['application_id'];
}

$filteredArray = array_filter($rows, function ($element) use ($groupIDs) {
    return !in_array($element['application_id'], $groupIDs);
});

// Reindex the array to remove any gaps in the keys
$filteredArray = array_values($filteredArray);



// echo '<pre>';
// print_r($filteredArray);
// echo '</pre>';
echo json_encode($filteredArray);
?>
