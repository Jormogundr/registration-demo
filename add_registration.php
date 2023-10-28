<?php
require_once('database.php');

$query = "SELECT * FROM student_registrations WHERE umid = ?";
$statement = $db->prepare($query);
$statement->execute([$umid]);
$student = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();

// check if umid already exists in table, else INSERT it
if ($student) {
    echo 'Student registration matching provided UMID already exists in db';

    // ask user if they'd like to update their registration

    // if yes, drop the current record and add new

    // else, cancel insert
}
else {
    $query = "INSERT INTO student_registrations (umid, first_name, last_name, project_name, email_address, phone_number, seat) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $statement = $db->prepare($query);
    $statement->execute([$umid, $first_name, $last_name, $project_name, $email_address, $phone_number, $seat]);
    echo "Successfully inserted new record.";
}