<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve the form data
    $department_name = $_POST['department_name'];
    $course_name = $_POST['course_name'];
    $project_name = $_POST['project_name'];
    $project_description = $_POST['project_description'];
    $skill_needed = $_POST['skill_needed'];
    $notes = $_POST['notes'];
    $application_date = date('Y-m-d H:i:s');
    $user_ID = $_SESSION["user_ID"];

    // Prepare SQL
    //$sql = "INSERT INTO experience (type, groupName, position, startDate, endDate, description, user_ID, duration) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    

    echo $application_id;

    $sql = "INSERT INTO `group-application`(`department_name`, `course_name`, `project_name`, `project_description`, `skill_needed`, `notes`, `application_date`, `user_ID`) VALUES (?,?,?,?,?,?,?,?)";

    $stmt = $connection->prepare($sql);

    $stmt->bind_param("ssssssss", $department_name, $course_name, $project_name, $project_description, $skill_needed, $notes, $application_date, $user_ID);

    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        $application_id = $stmt->insert_id;
        
        echo "Experience added successfully!";
        header("Location: ../../group_application_view.php?application_ID=" . $application_id);

    } else {
        echo "Failed to add experience.";
    }

    

    // // Check if the connection to the database is successful
    // if (mysqli_connect_errno()) {
    //     die("Failed to connect to MySQL: " . mysqli_connect_error());
    // }

    // // Prepare and execute the query to insert data into the database
    // $stmt = $connection->prepare("INSERT INTO group_application (department_name, course_name, project_name, project_description, skill_needed, notes, application_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    // $stmt->bind_param("sssssss", $department_name, $course_name, $project_name, $project_description, $skill_needed, $notes, $application_date);

    // if ($stmt->execute()) {
    //     // Check if the query execution was successful
    //     if ($stmt->affected_rows > 0) {
    //         // Redirect the user back to the form page after processing the form data
    //         header("Location: ../../group-application.html");
    //         exit; // Terminate the script after redirection
    //     } else {
    //         // Display an error message if the query failed
    //         echo "Error: Failed to insert data into the database.";
    //     }
    // } else {
    //     // Display an error message if the query failed to execute
    //     echo "Error: Failed to execute the query.";
    // }

    // // Close the database connection
    // $connection->close();
}
?>