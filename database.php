<?php

// Define PHP DB object as needed
$dsn = 'mysql:host=localhost;dbname=students';
$username = 'admin';
$password = 'admin';

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "<p>An error occurred while connecting to
    the database: $error_message </p>";
    include('database_error.php');
    exit();
}

?>