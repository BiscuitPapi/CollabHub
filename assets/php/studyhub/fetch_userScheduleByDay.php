<?php
    include("../connection.php");

    $selectedDay = mysqli_real_escape_string($connection, $_POST['selectedDay']);
    $studyhub_ID = mysqli_real_escape_string($connection, $_POST['studyhub_ID']);

    // Empty array to store student IDs and start times
    $output = [];

    // Get user ID of students belonging to the studyhub
    $sql1 = "SELECT user_ID FROM studyhubMember WHERE studyhub_ID = $studyhub_ID";
    $result1 = mysqli_query($connection, $sql1);

    if ($result1) {
        // Store user IDs in an array
        while ($row1 = mysqli_fetch_assoc($result1)) {
            $user_ID = $row1['user_ID'];

            // Get student schedule based on user_ID and selected day
            $sql2 = "SELECT schedule_ID, start_time, duration
                FROM  `schedule` 
                WHERE user_ID = $user_ID
                AND day = '$selectedDay'";

            $result2 = mysqli_query($connection, $sql2);

            if ($result2) {
                // Store the user_ID and associated start times in an array
                $userSchedule = [
                    'user_ID' => $user_ID,
                    'schedule' => []
                ];

                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $userSchedule['schedule'][] = [
                        'start_time' => $row2['start_time'],
                        'duration' => $row2['duration']
                    ];
                }

                // Add the user_ID and associated start times array to the output
                $output[] = $userSchedule;
            }
        }
    }

    echo json_encode($output);

    mysqli_close($connection);

?>