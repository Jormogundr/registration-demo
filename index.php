<?php

require 'database.php';


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
}

// form input validation

// umid
if (strlen($umid) != 8 || !is_numeric($umid)) {
  $error_message = 'UMID must be numeric of length 8';
  array_push($errors, $error_message);
}

// first name
if (!preg_match ("/^[a-zA-z]*$/", $first_name)) {
  $error_message = 'First name must contain only letters';
  array_push($errors, $error_message);
}

// last name
if (!preg_match ("/^[a-zA-z]*$/", $last_name)) {
  $error_message = 'Last must contain only letters';
  array_push($errors, $error_message);
}
// email
if (!filter_var($email_address, FILTER_VALIDATE_EMAIL) ){  
  $error_message = 'Invalid email address';
  array_push($errors, $error_message);
}

// phone number 
if (!preg_match ("^[2-9]\d{2}-\d{3}-\d{4}$", $phone_number) ){  
  $error_message = 'Invalid phone number';
  array_push($errors, $error_message);
}

// append each error message to marked up object
foreach ($errors as $error) {
  $errmsg .= '• ' . $error . '<br />';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="An interface for submitting term project registrations for demos.">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="CIS525 web technologies university of michigan dearborn term project">

  <title>Demonstration Form </title>
  <link rel="shortcut icon" href="img/favicon.png">
  <link rel="stylesheet" href="styles/index.css">

  <noscript>
    <h2>To get the most from this website, please enable JavaScript
      in your browser.</h2>
  </noscript>
</head>

<body>
  <header>
    <h1 id="title">CIS525 Demonstration Reservation</h1>
  </header>
  <main>
    <h1>Book a time for your term project demonstration</h1>
    <form id="registration_form" method="POST" action="index.php">
      <!--Print form errors -->
      <?php if ($errmsg != '') : ?>
        <p style="color: red;"><b>Please correct the following errors:</b><br />
          <?php echo $errmsg; ?>
        </p>
      <?php endif; ?>

      <span>
        <label for="umid"><b>UMID</b></label>
        <input type="text" placeholder="Enter UMID number" name="umid" required>
      </span>

      <span>
        <label for="first_name"><b>First name</b></label>
        <input type="text" placeholder="Enter your first name" name="first_name" required>
      </span>

      <span>
        <label for="last_name"><b>Last name</b></label>
        <input type="text" placeholder="Enter your last name" name="last_name" required>
      </span>

      <span>
        <label for="project_name"><b>Project name</b></label>
        <input type="text" placeholder="Enter your project's name" name="project_name" required>
      </span>

      <span>
        <label for="email_address"><b>Email address</b></label>
        <input type="text" placeholder="Enter your email address" name="email_address" required>
      </span>

      <span>
        <label for="phone_number"><b>Phone number</b></label>
        <input type="text" placeholder="Enter your phone number" name="phone_number" required>
      </span>

      <span>
        <label for="seat"><b>Seat</b></label>
        <select name="seat" id="seat">
          <option value="1">12/5/23, 6:00 PM – 7:00 PM</option>
          <option value="2">12/5/23, 7:00 PM – 8:00 PM</option>
          <option value="3">12/5/23, 8:00 PM – 9:00 PM</option>
          <option value="4">12/6/23, 6:00 PM – 7:00 PM</option>
          <option value="5">12/6/23, 7:00 PM – 8:00 PM</option>
          <option value="6">12/6/23, 8:00 PM – 9:00 PM</option>
        </select>
      </span>

      <span>
        <label for="submit"><b>&nbsp</b></label>
        <input type="submit" value="Submit">
      </span>


    </form>
  </main>

  <aside>
  </aside>
</body>

</html>