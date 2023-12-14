<?php
$input_text = "I recently started a new job, and although the workload is heavy, the supportive team and interesting projects make it an enjoyable and fulfilling experience.";
$escaped_text = urlencode($input_text);
$flask_app_url = 'http://127.0.0.1:5000';
$url = "{$flask_app_url}/?text={$escaped_text}";

$response = file_get_contents($url);

if ($response !== false) {
    // Attempt to decode the response as JSON
    $jsonResponse = json_decode($response, true);

    if ($jsonResponse !== null && isset($jsonResponse['positive_percent'])) {
        // Extract the positive percentage from the JSON response
        $positivePercentage = $jsonResponse['positive_percent'];

        // Print the positive percentage
        echo "Positive: {$positivePercentage}%";
    } else {
        echo "Error decoding JSON or missing positive percentage.";
    }
} else {
    echo "Error making HTTP request.";
}
?>
