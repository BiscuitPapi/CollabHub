<?php
include("connection.php");
session_start();

$sb_ID = $_POST["studyhub_ID"];

$query = "SELECT profile_pic FROM studyhub WHERE studyhub_ID = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $sb_ID); // Assuming profile_pic is a string, change "s" to "b" if it's a blob
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if (array_key_exists('profile_pic', $row) && $row['profile_pic'] !== null) {
        $base64Image = base64_encode($row['profile_pic']);
        $imageObj = array(
            "imageBase64" => $base64Image,
            "imageType" => "image/jpeg" // Set the appropriate image type
        );
        echo json_encode($imageObj); // Echo the image as JSON
    } else {
        echo "No image found.";
    }
} else {
    echo "No results found.";
}

$stmt->close();
$connection->close();
?>
