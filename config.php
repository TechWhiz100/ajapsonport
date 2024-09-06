<?php

// Database connection details
$db_name = "mysql:host=localhost;dbname=ajapson_db";
$username = "root";
$password = "";

try {
    // Creating a new PDO connection
    $conn = new PDO($db_name, $username, $password);

    // Setting PDO attributes
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Connection successful
    // echo "Connected successfully"; // You can uncomment this line for testing

} catch (PDOException $e) {
    // Handling connection errors
    echo "Connection failed: " . $e->getMessage();
    exit();
}

?>
