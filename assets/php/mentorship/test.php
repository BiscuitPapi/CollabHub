<?php include("../connection.php");

$query = "SELECT u.picture, u.user_ID, u.name, u.rating, COUNT(CASE WHEN m.status = 'Approved' THEN m.Mentee_ID END) AS numberOfMentees
    FROM user u
    LEFT JOIN mentorship m ON u.user_ID = m.Mentor_ID
    WHERE u.mentorshipStatus = 'Mentor'
    GROUP BY u.user_ID, u.name, u.rating";

$result = mysqli_query($connection, $query);

$count = 1; // Initialize count variable
