<?php

require("database.php");
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
    $errmsg = '';

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
    elseif (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone_number)) {
        $error_message = 'Invalid phone number, please use XXX-XXX-XXXX format.';
        array_push($errors, $error_message);
        $_POST['phone_number'] = '';
        $isValidForm = false;
    }


    // seat -- check there is a seat avaialble during the selected timeslot
    elseif (!seatIsOpen($_POST['seat'])) {
        $error_message = 'Not enough seats available for selected timeslot.';
        array_push($errors, $error_message);
        $_POST['seat'] = '';
        $isValidForm = false;
    } else {
        $isValidForm = true;
    }

    // append each error message to marked up object
    foreach ($errors as $error) {
        $errmsg .= '• ' . $error . '<br />';
    }

    global $overwrite;
    if ($_POST['overwrite'] == 'true') {
        $overwrite = "true";
    }
    else {
        $overwrite = "false";
    }

}


// Returns an array with an element for each seat available where values correspond to number of remaining free seats
function getNumberOfSeats()
{
    require("database.php");
    $seatsRemaining = array();


    for ($i = 1; $i < 7; $i++) {
        try {
            $query = "SELECT COUNT(*) FROM student_registrations WHERE seat = ?";
            $statement = $db->prepare($query);
            $statement->execute([$i]);
            $count = $statement->fetchColumn();
            $statement->closeCursor();
            $free = 6 - $count;
            array_push($seatsRemaining, $free);
        } catch (PDOException $e) {
            echo "DataBase Error <br>" . $e->getMessage();
        } catch (Exception $e) {
            echo "General Error <br>" . $e->getMessage();
        }
    }
    return $seatsRemaining;
}

// given a selected seat idx, return true if there is a seat avaialble for the timeslot, else false 
function seatIsOpen($seat)
{
    $seats = getNumberOfSeats();
    if ($seats[$seat - 1] > 0) {
        return true;
    } else {
        return false;
    }
}
