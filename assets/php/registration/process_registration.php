<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../connection.php");

// Read JSON data from the request body
$jsonData = file_get_contents("php://input");

// Decode the JSON data
$data = json_decode($jsonData);

// Check if the required data is present
if ($data !== null && isset($data->name) && isset($data->email) && isset($data->mobile) && isset($data->matricNum) && isset($data->year) && isset($data->department) && isset($data->password)) {
    // Sanitize data
    $name = mysqli_real_escape_string($connection, $data->name);
    $email = mysqli_real_escape_string($connection, $data->email);
    $mobile = mysqli_real_escape_string($connection, $data->mobile);
    $matricNum = mysqli_real_escape_string($connection, $data->matricNum);
    $year = mysqli_real_escape_string($connection, $data->year);
    $department = mysqli_real_escape_string($connection, $data->department);
    $password = password_hash($data->password, PASSWORD_DEFAULT); // Hash the password

    mysqli_query($connection, "INSERT INTO user(name,password,email,mobile, matricNum, year, department) VALUES('$name','$password','$email','$mobile','$matricNum','$year','$department')");
} else {
    // Display the missing fields
    echo "Missing fields: ";
    $missingFields = [];
    if (!isset($data->name)) {
        $missingFields[] = "name";
    }
    if (!isset($data->email)) {
        $missingFields[] = "email";
    }
    if (!isset($data->mobile)) {
        $missingFields[] = "mobile";
    }
    if (!isset($data->matricNum)) {
        $missingFields[] = "matricNum";
    }
    if (!isset($data->year)) {
        $missingFields[] = "year";
    }
    if (!isset($data->department)) {
        $missingFields[] = "department";
    }
    if (!isset($data->password)) {
        $missingFields[] = "password";
    }
    echo implode(", ", $missingFields);
}
?>
