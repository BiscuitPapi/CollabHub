<?php
include("../connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $exp_ID = $_POST['exp_ID']; // Change to $_POST
    $type = $_POST["input1"]; // Change to input1
    $groupName = $_POST["input2"]; // Change to input2
    $position = $_POST["input3"]; // Change to input3
    $startDate = $_POST["input4"]; // Change to input4
    $endDate = $_POST["input5"]; // Change to input5
    $description = $_POST["input6"]; // Change to input6
    $user_ID = $_SESSION['user_ID'];

    $date1 = new DateTime($startDate);
    $date2 = new DateTime($endDate);

    $interval = $date1->diff($date2);

    $years = $interval->y;
    $months = $interval->m;
    $days = $interval->d;

    $duration = '';

    if ($years != 0) {
        $duration .= $years . ' years, ';
    }

    if ($months != 0) {
        $duration .= $months . ' months, ';
    }

    if ($days != 0) {
        $duration .= $days . ' days';
    }

    // Remove the final comma and space, if present
    $duration = rtrim($duration, ', ');

    $description = mysqli_real_escape_string($connection, $description);
    mysqli_query($connection, "UPDATE experience SET 
                              type = '$type',
                              groupName = '$groupName',
                              position = '$position',
                              startDate = '$startDate',
                              endDate = '$endDate',
                              description = '$description',
                              duration = '$duration'
                            WHERE exp_ID = '$exp_ID'");

    echo "success";
}
?>
