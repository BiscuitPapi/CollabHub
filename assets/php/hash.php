<?php
include("connection.php");

$sql = "SELECT user_ID, password FROM user";
$result = mysqli_query($connection, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $user_ID = $row['user_ID'];
    $currentPassword = $row['password'];

    // Hash the current password using PHP's password_hash function
    $hashedPassword = password_hash($currentPassword, PASSWORD_DEFAULT);

    // Update the database with the hashed password
    $updateQuery = "UPDATE user SET password = '$hashedPassword' WHERE user_ID = $user_ID";
    mysqli_query($connection, $updateQuery);
}

echo "Password migration completed successfully.";
?>
