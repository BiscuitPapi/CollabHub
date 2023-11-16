<?php
    include("connection.php");
    session_start();

    $studyHub_ID = $_POST['studyHub_ID'];
    $user_ID = $_POST['user_ID'];

    // Correct the SQL syntax - should use VALUES() with INSERT INTO
    $sql = "INSERT INTO invitation (studyHub_ID, user_ID) VALUES (?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ii", $studyHub_ID, $user_ID);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
?>
