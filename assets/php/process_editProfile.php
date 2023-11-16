<?php
include("connection.php");
// Start the session to access the user_ID value
session_start();

// Check if the user is logged in and the user_ID is set
if (isset($_SESSION["user_ID"])) {
    // Include the database connection file
    include 'connection.php';

    // Get the user ID from the session
    $userID = $_SESSION["user_ID"];

    // Check if the matricNum, mobile, position, and about values were posted
    if (isset($_POST['matricNum']) && isset($_POST['mobile']) && isset($_POST['position']) && isset($_POST['about'])) {
        // Retrieve the matricNum, mobile, position, and about values
        $newMatricNum = $_POST['matricNum'];
        $newMobile = $_POST['mobile'];
        $newPosition = $_POST['position'];
        $newAbout = $_POST['about'];

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
