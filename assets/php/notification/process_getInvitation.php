<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include("../connection.php");
    session_start();
    // Assuming $connection is your database connection
    if (isset($_SESSION['user_ID'])) {
        $user_ID = $_SESSION['user_ID'];

        $studyhubDetails = array();

        // Your SQL query to fetch data (replace table/column names with your actual ones)
        $sql = "SELECT i.invite_ID, i.type, sh.studyhub_ID, sh.studyhub_name, sh.profile_pic 
                FROM studyhub sh 
                INNER JOIN invitation i ON sh.studyhub_ID = i.studyHub_ID 
                WHERE i.user_ID = $user_ID AND i.status = 'Pending'";

        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Assuming profile_pic is binary data
                $profilePic = $row['profile_pic'];
                if ($profilePic !== null) {
                    $profilePicBase64 = base64_encode($profilePic);
                } else {
                    $profilePicBase64 = null; // Handle null case or empty data as needed
                }

                $studyhubDetails[] = array(
                    'invite_ID' => $row['invite_ID'],
                    'type' => $row['type'],
                    'studyhub_ID' => $row['studyhub_ID'],
                    'studyhub_name' => $row['studyhub_name'],
                    'profile_pic' => $profilePicBase64
                );
            }

            // Return the study hub details in JSON format
            header('Content-Type: application/json');
            echo json_encode($studyhubDetails);
        } else {
            // If no data found, return an empty JSON array
            echo json_encode(array());
        }
    } else {
        // Handle the case when the user is not logged in or session variables are not set
        echo json_encode(array('error' => 'User not logged in'));
    }
?>

