<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include("assets/php/connection.php");
$sql = "SELECT review_ID FROM feedback WHERE reviewee = '{$_SESSION["user_ID"]}' AND review_ID IS NOT NULL;";
$result = mysqli_query($connection, $sql);

if ($result) {
    $totalReview = 0;
    $totalStars = array(0, 0, 0, 0, 0, 0); // Array to store counts for each star rating (0 to 5)

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $review_ID = $row['review_ID'];
            $sql_2 = "SELECT stars FROM review WHERE review_ID = '$review_ID';";
            $result_2 = mysqli_query($connection, $sql_2);

            if ($result_2) {
                while ($row_2 = mysqli_fetch_assoc($result_2)) {
                    $stars = $row_2['stars'];

                    // Increment the corresponding star count
                    $totalStars[$stars]++;

                    $totalReview++;
                }
                mysqli_free_result($result_2);
            } else {
                echo "Error: " . mysqli_error($connection);
            }
        }
    }

    mysqli_free_result($result);
} else {
    echo "Error: " . mysqli_error($connection);
}


?>