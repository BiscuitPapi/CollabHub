<?php


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

?>
