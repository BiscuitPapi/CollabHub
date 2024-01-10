<?php
include("connection.php");
session_start();

$studyhub_ID = $_POST['studyhub_ID'];
$user_ID = $_SESSION['user_ID'];

// Creation for review purposes
$query = "SELECT user_ID FROM studyhubMember WHERE studyhub_ID = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("i", $studyhub_ID);
$stmt->execute();
$result = $stmt->get_result(); // Use get_result to fetch results

if ($result) {
  if ($stmt->error) {
    echo "Error: " . $stmt->error;
  } else {
    // Inside the while loop for fetching studyhub_members
    while ($row = $result->fetch_assoc()) {
      $reviewee = $row['user_ID'];
      $reviewer = $_SESSION["user_ID"];

      // Insert feedback record for the original reviewer reviewing the original reviewee
      $insertQuery1 = "INSERT INTO feedback (reviewer, reviewee) VALUES (?, ?)";
      $insertStmt1 = $connection->prepare($insertQuery1);
      $insertStmt1->bind_param("ii", $reviewer, $reviewee);
      $insertStmt1->execute();
      $insertStmt1->close();

      // Insert feedback record for the original reviewee reviewing the original reviewer
      $insertQuery2 = "INSERT INTO feedback (reviewer, reviewee) VALUES (?, ?)";
      $insertStmt2 = $connection->prepare($insertQuery2);
      $insertStmt2->bind_param("ii", $reviewee, $reviewer);
      $insertStmt2->execute();
      $insertStmt2->close();
    }
    
  }

  // Insert the user into the studyhubMember table
  $insertStmt = $connection->prepare("INSERT INTO studyhubMember (studyhub_ID, user_ID) VALUES (?, ?)");
  $insertStmt->bind_param("ii", $studyhub_ID, $user_ID);
  $insertStmt->execute();
  $insertStmt->close();

  echo "success";
} else {
  echo "Failed to save changes!";
}
?>
