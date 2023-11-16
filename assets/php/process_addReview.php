<?php
include("connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reviewee_ID = $_POST["input_1"];
    $stars = $_POST["input_2"];
    $comments = $_POST["input_3"];

    // 1) Insert into the review table
    $insertReviewQuery = "INSERT INTO review (dateCreated, comments, stars) VALUES (CURRENT_DATE(), ?, ?)";
    $stmt = $connection->prepare($insertReviewQuery);
    $stmt->bind_param("ss", $comments, $stars);
    $stmt->execute();

    // 2) Get the latest review_ID
    $latestReviewIDQuery = "SELECT review_ID FROM review ORDER BY review_ID DESC LIMIT 1";
    $latestReviewIDResult = mysqli_query($connection, $latestReviewIDQuery);
    $row = mysqli_fetch_assoc($latestReviewIDResult);
    $review_ID = $row['review_ID'];

    // 3) Update the feedback table with the review_ID
    $updateFeedbackQuery = "UPDATE feedback SET review_ID = ? WHERE reviewee = ? AND reviewer = ?";
    $stmt = $connection->prepare($updateFeedbackQuery);
    $stmt->bind_param("sss", $review_ID, $reviewee_ID, $_SESSION['user_ID']);
    $stmt->execute();

    // 4) Update the rating in the user table
    $getReviewIDsQuery = "SELECT review_ID FROM feedback WHERE reviewee = ?";
    $stmt = $connection->prepare($getReviewIDsQuery);
    $stmt->bind_param("s", $reviewee_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $reviewIDs = array();
    while ($row = $result->fetch_assoc()) {
        $reviewIDs[] = $row['review_ID'];
    }

    $totalStars = 0;
    $reviewCount = count($reviewIDs);

    foreach ($reviewIDs as $reviewID) {
        $getStarsQuery = "SELECT stars FROM review WHERE review_ID = ?";
        $stmt = $connection->prepare($getStarsQuery);
        $stmt->bind_param("s", $reviewID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $row = $result->fetch_assoc();
        $totalStars += $row['stars'];
    }

    $averageStars = $totalStars / $reviewCount;

    $updateRatingQuery = "UPDATE user SET rating = ? WHERE user_ID = ?";
    $stmt = $connection->prepare($updateRatingQuery);
    $stmt->bind_param("ss", $averageStars, $reviewee_ID);
    $stmt->execute();

    $stmt->close();
    $connection->close();
}

header("Location: ../../peerReview.php");
?>
