<?php
session_start();

// Check the parameter value
if ($_GET['picture'] === 'profile') {
    if (isset($_GET['user_ID'])) {
        $userID = $_GET['user_ID'];

        include('../connection.php');

        // Retrieve the user record from the database based on the user ID
        $sql = "SELECT * FROM user WHERE user_ID='$userID'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            $res = $result->fetch_assoc();
            $imageData = $res['picture'];

            if (empty($imageData)) {
                $imageData = file_get_contents('https://via.placeholder.com/110x110');
            }

            header('Content-Type: image/jpeg');

            $image = imagecreatefromstring($imageData);
            $reshapedImage = imagecreatetruecolor(110, 110);
            imagecopyresampled($reshapedImage, $image, 0, 0, 0, 0, 110, 110, imagesx($image), imagesy($image));
            imagejpeg($reshapedImage);

            imagedestroy($image);
            imagedestroy($reshapedImage);
        } else {
            $imageData = file_get_contents('https://via.placeholder.com/110x110');
            header('Content-Type: image/jpeg');
            echo $imageData;
        }
    } else {
        // Invalid or missing user_ID parameter
        echo "Invalid user_ID parameter.";
    }
} elseif ($_GET['picture'] === 'banner') {
   if (isset($_GET['user_ID'])) {
        $userID = $_GET['user_ID'];

        include('../connection.php');

        // Retrieve the user record from the database based on the user ID
        $sql = "SELECT * FROM user WHERE user_ID='$userID'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            $res = $result->fetch_assoc();
            $imageData = $res['banner'];

            if (empty($imageData)) {
                $imageData = file_get_contents('https://via.placeholder.com/110x110');
            }

            header('Content-Type: image/jpeg');

            $image = imagecreatefromstring($imageData);
            $reshapedImage = imagecreatetruecolor(800, 500);
            imagecopyresampled($reshapedImage, $image, 0, 0, 0, 0, 800, 500, imagesx($image), imagesy($image));
            imagejpeg($reshapedImage);

            imagedestroy($image);
            imagedestroy($reshapedImage);
        } else {
            $imageData = file_get_contents('https://via.placeholder.com/110x110');
            header('Content-Type: image/jpeg');
            echo $imageData;
        }
    } else {
        // Invalid or missing user_ID parameter
        echo "Invalid user_ID parameter.";
    }
} else {
    // Invalid picture parameter
    echo "Invalid picture parameter.";
}
?>
