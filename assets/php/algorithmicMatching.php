<?php
    ob_clean(); // Clear output buffer
    ob_end_clean(); // End output buffering
 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include("connection.php");
    session_start();

    // Assuming $connection is your database connection variable

    // Retrieve the skills array from the AJAX request
    $receivedData = json_decode(file_get_contents('php://input'), true);
    $skillsArray = $receivedData['skillsArray'];
   // $skillsArray = ['Fishing', 'Diving', 'Swimming', 'Running']; // Replace this with your actual array of skills


    // Your algorithm to process the skills and generate the result
    // Perform the necessary database operations to find matching users

    // For instance, here's a simple SQL query to find users with the skills
    $query = "SELECT u.user_ID, u.picture, u.name, u.email, u.matricNum, u.position, b.name as badge_name
          FROM user u
          LEFT JOIN badge b ON u.user_ID = b.user_ID
          WHERE b.name IN ('" . implode("','", $skillsArray) . "')
          AND u.user_ID <> " . $_SESSION['user_ID'];

    $result = $connection->query($query);

    $users = array();

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $userID = $row['user_ID'];
            if (!isset($users[$userID])) {
                $imageData = ($row['picture'] !== null) ? base64_encode($row['picture']) : null;
                $users[$userID] = array(
                    'user_ID' => $row['user_ID'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'matricNum' => $row['matricNum'],
                    'position' => $row['position'],
                    'imageData' => $imageData,
                    'matched_skills' => array()
                );
            }
            

            // Store the matching skills for each user
            if (!empty($row['badge_name'])) {
                $users[$userID]['matched_skills'][] = $row['badge_name'];
            }
            
        

        }

        // Calculate percentage of matched skills for each user
        $totalSkillsCount = count($skillsArray);
        foreach ($users as $key => $user) {
            $matchedSkillsCount = count($user['matched_skills']);
            $percentage = ($matchedSkillsCount / $totalSkillsCount) * 100;
            $users[$key]['match_percentage'] = $percentage;
        }
    }

    // Return the result in JSON format
    header('Content-Type: application/json');
    echo json_encode(array_values($users));

?>