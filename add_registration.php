<?php


$query = $pdo->prepare("SELECT umid FROM student_registrations WHERE umid = ?");
echo $query;
// Display the Product List page



?>