<?php include("../connection.php");
session_start();

$query = "SELECT ca.club_name, ca.club_id, ca.position_available, cas.status FROM club AS ca JOIN `clubApplication` AS cas ON ca.club_id = cas.club_ID WHERE cas.applicant_ID = '{$_SESSION['user_ID']}';";

$result = mysqli_query($connection, $query);

$count = 1; // Initialize count variable
?>