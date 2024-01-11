<?php
session_start();

if (isset($_GET['user_ID'])) {
    // Include the connection file
    include('../connection.php');

    // Retrieve the user ID from the parameter
    $userID = $_GET['user_ID'];

    $sql = "SELECT * FROM user WHERE user_ID='$userID'";

    // Execute the query
    $result = mysqli_query($connection, $sql);

    // Check if the query returned any rows
    if (mysqli_num_rows($result) > 0) {
        // Fetch the user record
        $res = $result->fetch_assoc();

        // Retrieve the picture attribute
        $pictureData = $res['picture'];

        // If the picture is null or empty, use the placeholder URL
        if (empty($pictureData)) {
            $pictureData = file_get_contents('https://via.placeholder.com/110x110');
        }

        // Set the appropriate headers
        header('Content-Type: image/jpeg');

        // Load the picture
        $image = imagecreatefromstring($pictureData);

        // Create a new image with the desired dimensions
        $reshapedImage = imagecreatetruecolor(50, 50);

        // Resize the original image to the desired dimensions
        imagecopyresampled($reshapedImage, $image, 0, 0, 0, 0, 50, 50, imagesx($image), imagesy($image));

        // Output the resized profile picture
        imagejpeg($reshapedImage);

        // Clean up
        imagedestroy($image);
        imagedestroy($reshapedImage);
    } else {
        // User ID not found
        echo "User not found.";
    }

    // Close the database connection
    mysqli_close($connection);
} else {
    // Invalid parameter value
    echo "Invalid user ID parameter.";
}
?>
