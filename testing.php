<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include("assets/php/connection.php");

session_start();

$sql = "SELECT review_ID, reviewer FROM feedback WHERE reviewee = '{$_SESSION["user_ID"]}'";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $review_id = $row['review_ID'];
        $reviewer = $row['reviewer'];


        // Get reviewer's name from user table
        $sql_user = "SELECT name FROM user WHERE user_ID = '$reviewer'";
        $result_user = mysqli_query($connection, $sql_user);
        $row_user = mysqli_fetch_assoc($result_user);
        $reviewer_name = $row_user['name'];
        
        $review_sql = "SELECT comments, stars FROM review WHERE review_ID = '$review_id'";
        echo $review_id;
        $review_result = mysqli_query($connection, $review_sql);
        if (mysqli_num_rows($review_result) > 0) {
            while ($review_row = mysqli_fetch_assoc($review_result)) {
                echo " okay"; // Should show if there are rows
            }
        } else {
            echo "No rows found.";
        }
    }
} else {
    echo "No reviews found.";
}
?>