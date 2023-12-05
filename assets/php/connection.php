<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$servername = "localhost"; // replace with your server name if it's not localhost
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "collabhub"; // replace with your database name

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
// // require 'vendor/autoload.php'; // Load Composer autoloader
// // $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// // $dotenv->load();

// // Connect to PlanetScale using credentials stored in environment variables
// $mysqli = mysqli_init();
// $mysqli->ssl_set(NULL, NULL, "/etc/ssl/cert.pem", NULL, NULL);
// $mysqli->real_connect("aws.connect.psdb.cloud","zw85gjkci2ak5h6wzke0","pscale_pw_ifnwenVVTTsALNQVknnIljN3AZgsH7YxpzD6sELzKyV","collabhub");

// // Check connection
// if ($mysqli->connect_errno) {
//     echo "Failed to connect to MySQL: " . $mysqli->connect_error;
//     exit();
// }

// // Query to fetch list of tables
// $query = "SHOW TABLES";
// $result = $mysqli->query($query);

// if ($result) {
//     $tables = $result->fetch_all(MYSQLI_NUM);
//     if (!empty($tables)) {
//         echo "Tables in the database:\n";
//         foreach ($tables as $table) {
//             echo "- $table[0]\n";
//         }
//     } else {
//         echo "No tables found in the database.\n";
//     }
//     $result->close();
// } else {
//     echo "Error fetching tables: " . $mysqli->error;
// }

// $mysqli->close();
?>
