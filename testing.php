<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("assets/php/connection.php");
session_start();
$userID = 2; // or any other user ID

// First query to get studyhub_ID values
$query = "SELECT DISTINCT studyhub_ID
FROM studyhubMember sm
WHERE NOT EXISTS (
    SELECT 1
    FROM studyhubMember
    WHERE studyhub_ID = sm.studyhub_ID AND user_ID = ?
)
ORDER BY studyhub_ID ASC;";

try {
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $userID); // "i" represents the data type of the parameter (integer)
    $stmt->execute();
    $stmt->store_result(); // Store the result set
    $stmt->bind_result($studyhub_ID); // Bind the result variable
    $rows = array();
    while ($stmt->fetch()) {
        // Store the studyhub_ID in a variable for later use
        $currentStudyhubID = $studyhub_ID;

        // You can use $currentStudyhubID in another query here using mysqli
        $secondQuery = "SELECT * FROM studyhub WHERE studyhub_ID = ?";
        $stmt2 = $connection->prepare($secondQuery);
        $stmt2->bind_param("i", $currentStudyhubID); // Bind the studyhub_ID parameter
        $stmt2->execute();

        // Fetch and process the results of the second query
        $result2 = $stmt2->get_result();

        while ($row2 = $result2->fetch_assoc()) {
            $tempPicture = null;
            if ($row2['profile_pic'] !== null) {
                $base64Image = base64_encode($row2['profile_pic']);
                $imageObj = array(
                    "imageBase64" => $base64Image,
                    "imageType" => "image/jpeg" // Set the appropriate image type
                );
                $tempPicture = json_encode($imageObj);

            }

            $tempBackgroundPicture = null;
            if ($row2['background_pic'] !== null) {
                $base64Image = base64_encode($row2['background_pic']);
                $imageObj = array(
                    "imageBase64" => $base64Image,
                    "imageType" => "image/jpeg" // Set the appropriate image type
                );
                $tempBackgroundPicture = json_encode($imageObj);

            }

            // Add $tempPicture to $row_2
            $row2['profile_pic'] = $tempPicture;
            $row2['background_pic'] = $tempBackgroundPicture;
            echo $row2["studyhub_name"];

            $query_3 = "SELECT COUNT(*) AS row_count FROM `studyhubMember` WHERE studyhub_ID = ?";
            $stmt_3 = $connection->prepare($query_3);
            $stmt_3->bind_param("i", $currentStudyhubID);
            $stmt_3->execute();
            $stmt_3->bind_result($count);
            $stmt_3->fetch(); // Fetch the result
            $stmt_3->close(); // Close the statement for the third query

            $row2['row_count'] = $count;

            $query_4 = "SELECT name FROM user WHERE user_ID = ?";
            $stmt_4 = $connection->prepare($query_4);
            $stmt_4->bind_param("i", $row2['user_ID']);
            $stmt_4->execute();
            $stmt_4->bind_result($foundName);
            $stmt_4->fetch(); // Fetch the result
            $stmt_4->close(); // Close the statement for the fourth query

            $row2['foundName'] = $foundName;

            $row["studyhub_data"] = $row2;

            // Close the statement for the third query
        }

        // Free the result set for the second query
        $result2->free_result();


        // Close the statement for the second query
        $stmt2->close();
        $rows[] = $row;
        echo "<pre>";
        print_r($row);
        echo "</pre>";
    }
    echo json_encode($rows);

    // Close the statement for the first query
    $stmt->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>