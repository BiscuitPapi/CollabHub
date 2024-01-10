<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
session_start();


// Assuming $connection is your database connection
if (isset($_SESSION['user_ID']  )) {
    $user_ID = $_SESSION['user_ID'];

    $mmDetails = array();

    // Your SQL query to fetch data (replace table/column names with your actual ones)
    // Your SQL query with a prepared statement
    $sql = "SELECT u.user_ID, u.name, u.picture FROM user u INNER JOIN mentorship m ON u.user_ID = m.mentor_ID WHERE m.status = 'Waiting' AND m.mentee_ID = ?";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $user_ID); // Assuming $mentor_ID is an integer, adjust the type accordingly if it's a different data type
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Assuming profile_pic is binary data
            $profilePic = $row['picture'];
            if ($profilePic !== null) {
                $profilePicBase64 = base64_encode($profilePic);
            } else {
                $profilePicBase64 = null; // Handle null case or empty data as needed
            }

            $mmDetails[] = array(
                'user_ID' => $row['user_ID'],
                'name' => $row['name'],
                'profile_pic' => $profilePicBase64
            );
        }

        // Return the study hub details in JSON format
        header('Content-Type: application/json');
        echo json_encode($mmDetails);
    } else {
        // If no data found, return an empty JSON array
        echo json_encode(array());
    }
} else {
    // Handle the case when the user is not logged in or session variables are not set
    echo json_encode(array('error' => 'User not logged in'));
}
?>