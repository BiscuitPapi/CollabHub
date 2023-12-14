<?php
include("connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";

    // execute the query
    $result = mysqli_query($connection, $sql);

    // check if the query returned any rows
    if (mysqli_num_rows($result) > 0) {
        // email and password are correct
        $res = $result->fetch_assoc();
        $_SESSION['user_ID'] = $res['user_ID'];
        $_SESSION['name'] = $res['name'];
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;
        $_SESSION["mobile"] = $res['mobile'];
        $_SESSION["matricNum"] = $res['matricNum'];
        $_SESSION["about"] = $res['about'];
        $_SESSION["department"] = $res['department'];
        $_SESSION["year"] = $res['year'];
        $_SESSION["hobbies"] = $res['hobbies'];
        $_SESSION["position"] = $res['position'];

        // Store the banner picture properly as a base64-encoded string
        $bannerPicture = $res['banner_picture'];
        if ($bannerPicture !== null) {
            $_SESSION['banner'] = base64_encode($bannerPicture);
        } else {
            $_SESSION['banner'] = null;
        }

        // Store the banner picture properly as a base64-encoded string
        $picture = $res['picture'];
        if ($bannerPicture !== null) {
            $_SESSION['picture'] = base64_encode($picture);
        } else {
            $_SESSION['picture'] = null;
        }
        $_SESSION["mentorshipStatus"] = $res['mentorshipStatus'];

        echo "success";
    } else {
        // email and/or password are incorrect
        echo "error"; // Change this to "error" to distinguish from success
    }
}
?>
