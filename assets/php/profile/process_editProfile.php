<?php
// At the beginning of your PHP script
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../connection.php");
// Start the session to access the user_ID value
session_start();

// Check if the user is logged in and the user_ID is set
if (isset($_SESSION["user_ID"])) {
    // Include the database connection file
    include '../connection.php';

    // Get the user ID from the session
    $userID = $_SESSION["user_ID"];

    // Read JSON data from the request body
    $jsonData = file_get_contents("php://input");

    // Decode the JSON data
    $data = json_decode($jsonData);

    // Check if the required data is present
    if (isset($data->matricNum) && isset($data->mobile) && isset($data->position) && isset($data->about) && isset($data->year) && isset($data->department)) {
        // Retrieve the data
        $newMatricNum = $data->matricNum;
        $newMobile = $data->mobile;
        $newPosition = $data->position;
        $newAbout = $data->about;
        $newYear = $data->year;
        $newDepartment = $data->department;

        // Prepare the SQL statement
        $stmt = $connection->prepare("UPDATE user SET matricNum = ?, mobile = ?, position = ?, about = ?, year = ?, department = ? WHERE user_ID = ?");
        $stmt->bind_param("ssssssi", $newMatricNum, $newMobile, $newPosition, $newAbout, $newYear, $newDepartment, $userID);

        // Execute the statement
        if ($stmt->execute()) {
            // Update session values
            $_SESSION["matricNum"] = $newMatricNum;
            $_SESSION["mobile"] = $newMobile;
            $_SESSION["position"] = $newPosition;
            $_SESSION["about"] = $newAbout;
            $_SESSION["year"] = $newYear;
            $_SESSION["department"] = $newDepartment;

            echo "Profile information updated successfully.";

            // Close the statement
            $stmt->close();
        } else {
            echo "Error updating profile information: " . $connection->error;
        }
    } else {
        // Display the missing fields
        echo "Error: MatricNum, mobile, position, about, year, and department values are required. Missing fields: ";
        $missingFields = [];
        if (!isset($data->matricNum)) {
            $missingFields[] = "matricNum";
        }
        if (!isset($data->mobile)) {
            $missingFields[] = "mobile";
        }
        if (!isset($data->position)) {
            $missingFields[] = "position";
        }
        if (!isset($data->about)) {
            $missingFields[] = "about";
        }
        if (!isset($data->year)) {
            $missingFields[] = "year";
        }
        if (!isset($data->department)) {
            $missingFields[] = "department";
        }
        echo implode(", ", $missingFields);
    }
} else {
    echo "User is not logged in.";
}
?>
