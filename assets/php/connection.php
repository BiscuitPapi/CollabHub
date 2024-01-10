<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


use Dotenv\Dotenv;

require __DIR__ . '/../../vendor/autoload.php';

Dotenv::createUnsafeImmutable(__DIR__ . '/../../')->load();

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    //     Online
    $host = getenv("AWS_HOST");
    $username = getenv("AWS_USER");
    $password = getenv("AWS_PASSWORD");
    $database = getenv("AWS_DB_NAME");
    
    $ssl = "/etc/ssl/cert.pem";

    $connection = mysqli_init();
    mysqli_ssl_set($connection, NULL, NULL, $ssl, NULL, NULL);

    $connection->real_connect($host, $username, $password, $database);

    if ($connection->connect_error) {
        throw new Exception('Not connected to the database. Error: ' . $connection->connect_error);
    } else {
        // echo 'Connected successfully';
    }
} catch (Exception $e) {
    echo 'An error occurred: ' . $e->getMessage();
}