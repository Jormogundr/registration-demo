<?php

// Define PHP DB object as needed
$dsn = 'mysql:host=localhost;dbname=registration';
$username = 'admin';
$password = 'admin';

try {
    global $db;
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "<p>An error occurred while connecting to
    the database: $error_message </p>";
    include('database_error.php');
    exit();
}

?>