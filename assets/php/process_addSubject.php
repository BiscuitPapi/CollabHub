<?php
include("connection.php"); // Include your database connection file
session_start();

// User ID from the session
$user_ID = $_SESSION["user_ID"];

// Your new subject to be added
$newSubject = "Music";

// SQL query to retrieve the existing "subjects" data
$selectSql = "SELECT subjects FROM user WHERE user_ID = ?";
$selectStmt = $connection->prepare($selectSql);
$selectStmt->bind_param("i", $user_ID);

// Execute the select query
if ($selectStmt->execute()) {
    $selectStmt->bind_result($fetchedSubjectsJson);
    $selectStmt->fetch();

    // Decode the JSON data into an array
    $fetchedSubjectsArray = json_decode($fetchedSubjectsJson, true);

    // Print the existing subjects
    echo "Debug: Existing Subjects: ";
    print_r($fetchedSubjectsArray);
    echo "<br>";

    // Add the new subject to the existing array
    $fetchedSubjectsArray[] = $newSubject;

    // Print the updated subjects
    echo "Debug: Updated Subjects: ";
    print_r($fetchedSubjectsArray);
    echo "<br>";
    
    // Convert the updated array back to a JSON string
    $updatedSubjectsJson = json_encode($fetchedSubjectsArray);
    echo $updatedSubjectsJson;

    $stmt = $connection->prepare("UPDATE user SET matricNum = ?, mobile = ?, position = ?, about = ? WHERE user_ID = ?");
        $stmt->bind_param("ssssi", $newMatricNum, $newMobile, $newPosition, $newAbout, $userID);


   

   
} else {
    echo "Debug: Error retrieving existing subjects: " . $selectStmt->error . "<br>";
}

// Close the statements and the database connection
$selectStmt->close();
$updateStmt->close();
$connection->close();
?>
