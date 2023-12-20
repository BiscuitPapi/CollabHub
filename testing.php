<?php
//$input_text = "I recently started a new job, and although the workload is heavy, the supportive team and interesting projects make it an enjoyable and fulfilling experience.";
$input_text = "The support team was helpful in resolving my issues efficiently.";
$escaped_text = urlencode($input_text);
$flask_app_url = 'http://127.0.0.1:5000';
$url = "{$flask_app_url}/?text={$escaped_text}";

$response = file_get_contents($url);

if ($response !== false) {
    // Attempt to decode the response as JSON
    $jsonResponse = json_decode($response, true);

    if ($jsonResponse !== null && isset($jsonResponse['sentiment_label']) && isset($jsonResponse['sentiment_score'])) {
        // Extract sentiment label and score from the JSON response
        $sentimentLabel = $jsonResponse['sentiment_label'];
        $sentimentScore = $jsonResponse['sentiment_score'];
        $positivePercentage = $jsonResponse['positive_percent'];

        // Print the results
        echo "Sentiment Label: {$sentimentLabel}\n";
        echo "Sentiment Score: {$sentimentScore}\n";
        echo "Positive: {$positivePercentage}%\n";
    } else {
        echo "Error decoding JSON or missing sentiment label or score.";
    }
} else {
    echo "Error making HTTP request.";
}
?>
