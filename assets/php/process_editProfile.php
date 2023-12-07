<?php
// At the beginning of your PHP script
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
// Start the session to access the user_ID value
session_start();

// Check if the user is logged in and the user_ID is set
if (isset($_SESSION["user_ID"])) {
    // Include the database connection file
    include 'connection.php';

    // Get the user ID from the session
    $userID = $_SESSION["user_ID"];

    // Read JSON data from the request body
    $jsonData = file_get_contents("php://input");

    // Decode the JSON data
    $data = json_decode($jsonData);

    // Check if the required data is present
    if (isset($data->matricNum) && isset($data->mobile) && isset($data->position) && isset($data->about)) {
        // Retrieve the data
        $newMatricNum = $data->matricNum;
        $newMobile = $data->mobile;
        $newPosition = $data->position;
        $newAbout = $data->about;

        // Prepare the SQL statement
        $stmt = $connection->prepare("UPDATE user SET matricNum = ?, mobile = ?, position = ?, about = ? WHERE user_ID = ?");
        $stmt->bind_param("ssssi", $newMatricNum, $newMobile, $newPosition, $newAbout, $userID);

        // Execute the statement
        if ($stmt->execute()) {
            // Update session values
            $_SESSION["matricNum"] = $newMatricNum;
            $_SESSION["mobile"] = $newMobile;
            $_SESSION["position"] = $newPosition;
            $_SESSION["about"] = $newAbout;

            echo "Profile information updated successfully.";

            // Close the statement
            $stmt->close();
        } else {
            echo "Error updating profile information: " . $connection->error;
        }
    } else {
        echo "MatricNum, mobile, position, and about values are required.";
    }
} else {
    echo "User is not logged in.";
}
?>
