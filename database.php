<?php

// Define PHP DB object as needed
// change localhost to aws rds endpoint when ready to deploy to elastic beanstalk
// database-test1.cd9be3blyxm2.us-east-2.rds.amazonaws.com
$dsn = 'mysql:host=zedp1d.stackhero-network.com;dbname=registration';
$username = 'root';
$password = 'jz5jHP7FdVtXw9Yr20bBgn6ptnZKj1S6';

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