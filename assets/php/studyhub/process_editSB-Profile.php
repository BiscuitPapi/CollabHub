<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include("../connection.php");
    session_start();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["user_ID"])) {
    
        // Fetch studyHub_ID from the POST data
        $studyhub_ID = $_POST['studyHub_ID'];
    
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $bannerPicture = file_get_contents($_FILES['profile_picture']['tmp_name']);
            
            $stmt = $connection->prepare("UPDATE studyhub SET profile_pic = ? WHERE studyhub_ID = ?");
            $stmt->bind_param("si", $bannerPicture, $studyhub_ID);
    
            if ($stmt->execute()) {
                $response = array(
                    'status' => 'success',
                    'imageData' => base64_encode($bannerPicture)
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
