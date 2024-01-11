<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../connection.php");

// Start the session if not already started
if (!isset($_SESSION['user_ID'])) {
    session_start();
}

// Read JSON data from the request body
$jsonData = file_get_contents("php://input");

// Decode the JSON data
$data = json_decode($jsonData);

if ($data !== null && isset($data->reviewee) && isset($data->feedback_ID) && isset($data->comment)) {
    $reviewee_ID = mysqli_real_escape_string($connection, $data->reviewee);
    $feedback_ID = mysqli_real_escape_string($connection, $data->feedback_ID);
    $comment = mysqli_real_escape_string($connection, $data->comment);

    $escaped_text = urlencode($comment);
    $flask_app_url = 'http://127.0.0.1:5000';
    $url = "{$flask_app_url}/?text={$escaped_text}";

    $response = file_get_contents($url);

    if ($response !== false) {
        // Attempt to decode the response as JSON
        $jsonResponse = json_decode($response, true);

        if ($jsonResponse !== null && isset($jsonResponse['sentiment_label']) && isset($jsonResponse['sentiment_score'])) {

            $sentimentLabel = $jsonResponse['sentiment_label'];

            // Use preg_match to extract the numeric part
            if (preg_match('/(\d+)/', $sentimentLabel, $matches)) {
                $numericValue = $matches[1];
                // $numericValue now contains the extracted numeric part
            } else {
                // Handle the case where no numeric value is found
                echo "Numeric value not found";
            }
            $sentimentScore = $jsonResponse['sentiment_score'];
            $positivePercentage = $jsonResponse['positive_percent'];

        } else {
            echo "Error decoding JSON or missing positive percentage.";
        }
    } else {
        echo "Error making HTTP request.";
    }

    // Extract positive and negative percentages
    $positivePercent = $positivePercentage;
    $negativePercent = 100 - $positivePercent;

    // Format the percentages if needed
    $formattedPositivePercent = number_format($positivePercent, 2);
    $formattedNegativePercent = number_format($negativePercent, 2);


    // 1) Insert into the review table
    $insertReviewQuery = "INSERT INTO review (dateCreated, comments, stars, positivity, negativity) VALUES (CURRENT_DATE(), ?, ?, ?, ?)";
    $stmt = $connection->prepare($insertReviewQuery);
    $stmt->bind_param("ssdd", $comment, $numericValue, $formattedPositivePercent, $formattedNegativePercent);
    $stmt->execute();
    echo $numericValue;
    // Check for errors
    if ($stmt->error) {
        // Handle the error
        die("Error in insertReviewQuery: " . $stmt->error);
    }

    // 2) Get the latest review_ID
    $latestReviewIDQuery = "SELECT review_ID FROM review ORDER BY review_ID DESC LIMIT 1";
    $latestReviewIDResult = mysqli_query($connection, $latestReviewIDQuery);

    // Check for errors
    if (!$latestReviewIDResult) {
        // Handle the error
        die("Error in latestReviewIDQuery: " . mysqli_error($connection));
    }

    $row = mysqli_fetch_assoc($latestReviewIDResult);
    $review_ID = $row['review_ID'];

    // 3) Update the feedback table with the review_ID
    $updateFeedbackQuery = "UPDATE feedback SET review_ID = ? WHERE feedback_ID = ?";
    $stmt = $connection->prepare($updateFeedbackQuery);
    $stmt->bind_param("ii", $review_ID, $feedback_ID); // Assuming feedback_ID is an integer
    $stmt->execute();

    // Check for errors
    if ($stmt->error) {
        // Handle the error
        die("Error in updateFeedbackQuery: " . $stmt->error);
    }

    // 4) Update the rating in the user table
    $getReviewIDsQuery = "SELECT review_ID FROM feedback WHERE reviewee = ?";
    $stmt = $connection->prepare($getReviewIDsQuery);
    $stmt->bind_param("i", $reviewee_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check for errors
    if (!$result) {
        // Handle the error
        die("Error in getReviewIDsQuery: " . $stmt->error);
    }

    $reviewIDs = array();
    while ($row = $result->fetch_assoc()) {
        $reviewIDs[] = $row['review_ID'];
    }

    $totalStars = 0;
    $reviewCount = count($reviewIDs);

    foreach ($reviewIDs as $reviewID) {
        $getStarsQuery = "SELECT stars FROM review WHERE review_ID = ?";
        $stmt = $connection->prepare($getStarsQuery);
        $stmt->bind_param("i", $reviewID);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check for errors
        if (!$result) {
            // Handle the error
            die("Error in getStarsQuery: " . $stmt->error);
        }

        $row = $result->fetch_assoc();
        $totalStars += $row['stars'];
    }

    $averageStars = $reviewCount > 0 ? number_format($totalStars / $reviewCount, 2) : 0;

    $updateRatingQuery = "UPDATE user SET rating = ? WHERE user_ID = ?";
    $stmt = $connection->prepare($updateRatingQuery);
    $stmt->bind_param("di", $averageStars, $reviewee_ID);

    $stmt->execute();

    // Check for errors
    if ($stmt->error) {
        // Handle the error
        die("Error in updateRatingQuery: " . $stmt->error);
    }

    $stmt->close();
    $connection->close();
}
?>