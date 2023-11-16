<?php
include("connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $about = $_POST["newAbout"];
    $user_ID = $_SESSION['user_ID'];

    echo $about;

    // Prepare the SQL statement
    $sql = "UPDATE user SET about = ? WHERE user_ID = ?";

    // Create a prepared statement
    $stmt = $connection->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("si", $about, $user_ID);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Record updated successfully";

        $_SESSION["about"] = $about;
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}
?>
