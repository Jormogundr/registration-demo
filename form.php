<?php


$isValidForm = false;

// get the data from the form 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $umid = $_POST["umid"];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $project_name = $_POST['project_name'];
  $email_address = $_POST['email_address'];
  $phone_number = $_POST['phone_number'];
  $seat = $_POST['seat'];
  $errors = array();

  // form input validation. Set super global var fields for invalid entries to empty string, required for rendering in the html below.

  // umid
  if (strlen($umid) != 8 || !is_numeric($umid)) {
    $error_message = 'UMID must be numeric of length 8';
    array_push($errors, $error_message);
    $_POST['umid'] = '';
    $isValidForm = false;
  }

  // first name
  elseif (!preg_match("/^[a-zA-z]*$/", $first_name)) {
    $error_message = 'First name must contain only letters';
    array_push($errors, $error_message);
    $_POST['first_name'] = '';
    $isValidForm = false;
  }

  // last name
  elseif (!preg_match("/^[a-zA-z]*$/", $last_name)) {
    $error_message = 'Last must contain only letters';
    array_push($errors, $error_message);
    $_POST['last_name'] = '';
    $isValidForm = false;
  }
  // email
  elseif (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
    $error_message = 'Invalid email address';
    array_push($errors, $error_message);
    $_POST['email_address'] = '';
    $isValidForm = false;
  }

  // phone number 
  elseif (!preg_match("/^[0-9]{10}$/", $phone_number)) {
    $error_message = 'Invalid phone number';
    array_push($errors, $error_message);
    $_POST['phone_number'] = '';
    $isValidForm = false;
  } else {
    $isValidForm = true;
  }

  // append each error message to marked up object
  foreach ($errors as $error) {
    $errmsg .= '• ' . $error . '<br />';
  }
}


// Returns an array with an element for each seat available where values correspond to number of remaining free seats
function getNumberOfSeats() {
    require_once("database.php");
    $seatsRemaining = array();

    for ($i = 1; $i < 7; $i++) {
        $query = "SELECT COUNT(*) FROM student_registrations WHERE seat = ?";
        $statement = $db->prepare($query);
        $statement->execute([$i]);
        $count = $statement->fetchColumn();
        $statement->closeCursor();
        $free = 6 - $count;
        array_push($seatsRemaining, $free);
    }
    return $seatsRemaining;
}

?>
