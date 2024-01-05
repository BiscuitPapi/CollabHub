<?php
include("connection.php");

if ((isset($_POST["password"]))&& (isset($_POST["email"]))) {
    // Validate and sanitize inputs
    $newPassword = $_POST["password"];
    $email = $_POST["email"];

    // Hash the password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Prepare the SQL update statement
    $sql = "UPDATE user SET password = ? WHERE email = ?";
    $stmt = $connection->prepare($sql);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("ss", $hashedPassword, $email);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Password updated successfully";
        } else {
            echo "Error updating password: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $connection->error;
    }
} else {
    echo "Invalid or incomplete data received.";
}
?>
