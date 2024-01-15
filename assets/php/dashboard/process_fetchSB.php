<?php
include("../connection.php");
session_start();
    $query = "SELECT DISTINCT studyhub_ID
    FROM studyhubMember sm
    WHERE NOT EXISTS (
        SELECT 1
        FROM studyhubMember
        WHERE studyhub_ID = sm.studyhub_ID AND user_ID = ?
    )
    ORDER BY studyhub_ID ASC;";    

$userID = $_SESSION["user_ID"];
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $userID);
$stmt->execute();

if ($stmt->error) {
    echo "Error: " . $stmt->error;
} else {
    $result = $stmt->get_result();
    $rows = array();

    while ($row = $result->fetch_assoc()) {
        $query_2 = "SELECT * FROM studyhub WHERE studyhub_ID = ?";
        $stmt_2 = $connection->prepare($query_2);
        $stmt_2->bind_param("i", $row["studyhub_ID"]);
        $stmt_2->execute();
        $result_2 = $stmt_2->get_result();

        while ($row_2 = $result_2->fetch_assoc()) {
            $tempPicture = null;
            if ($row_2['profile_pic'] !== null) {
                $base64Image = base64_encode($row_2['profile_pic']);
                $imageObj = array(
                    "imageBase64" => $base64Image,
                    "imageType" => "image/jpeg" // Set the appropriate image type
                );
                $tempPicture = json_encode($imageObj);

            }

            $tempBackgroundPicture = null;
            if ($row_2['background_pic'] !== null) {
                $base64Image = base64_encode($row_2['background_pic']);
                $imageObj = array(
                    "imageBase64" => $base64Image,
                    "imageType" => "image/jpeg" // Set the appropriate image type
                );
                $tempBackgroundPicture = json_encode($imageObj);

            }

            // Add $tempPicture to $row_2
            // $row_2['username'] = $name;
            $row_2['profile_pic'] = $tempPicture;
            $row_2['background_pic'] = $tempBackgroundPicture;

            $query_3 = "SELECT COUNT(*) AS row_count FROM `studyhubMember` WHERE studyhub_ID = ?";
            $stmt_3 = $connection->prepare($query_3);
            $stmt_3->bind_param("i", $row["studyhub_ID"]);
            $stmt_3->execute();
            $result_3 = $stmt_3->get_result();
            $row_3 = $result_3->fetch_assoc();
            $rowCount = $row_3['row_count'];

            $stmt_3->close();

            $row_2['row_count'] = $rowCount;

            $query_4 = "SELECT name FROM user WHERE user_ID = ?";
            $stmt_4 = $connection->prepare($query_4);
            $stmt_4->bind_param("i", $row_2['user_ID']);
            $stmt_4->execute();
            $stmt_4->bind_result($foundName);
            $stmt_4->fetch();
            $stmt_4->close();

            $row_2['foundName'] = $foundName;

            $row["studyhub_data"] = $row_2;

           
        }
      

        // echo "<pre>";
        // print_r($row);
        // echo "</pre>";
        $rows[] = $row;     
    }

    $stmt->close();
    echo json_encode($rows);
}
?>