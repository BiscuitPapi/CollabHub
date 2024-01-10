<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["user_ID"])) {
    $user_ID = $_SESSION["user_ID"];

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $profilePicture = file_get_contents($_FILES['profile_picture']['tmp_name']);
        
        $stmt = $connection->prepare("UPDATE user SET picture = ? WHERE user_ID = ?");
        $stmt->bind_param("si", $profilePicture, $user_ID);

        if ($stmt->execute()) {
            // Update the session banner here
            $_SESSION['picture'] = base64_encode($profilePicture); // Assuming bannerPicture is binary data

            $response = array(
                'status' => 'success',
                'imageData' => base64_encode($profilePicture)
            );

            // Send the response as JSON
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error uploading the profile picture.";
    }
}

?>
