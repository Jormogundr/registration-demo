<?php
require('database.php');

// query database for possible existing umid 
try {
    $query = "SELECT * FROM student_registrations WHERE umid = ?";
    $statement = $db->prepare($query);
    $statement->execute([$umid]);
    $student = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();
} catch (PDOException $e) {
    echo "DataBase Error <br>" . $e->getMessage();
} catch (Exception $e) {
    echo "General Error<br>" . $e->getMessage();
}

if ($student) {    
    if ($overwrite == 'true') {
        try {
            $query = "REPLACE INTO student_registrations (umid, first_name, last_name, project_name, email_address, phone_number, seat) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $statement = $db->prepare($query);
            $statement->execute([$umid, $first_name, $last_name, $project_name, $email_address, $phone_number, $seat]);
            echo "Successfully replaced record.";
        } catch (PDOException $e) {
            echo "DataBase Error <br>" . $e->getMessage();
        } catch (Exception $e) {
            echo "General Error <br>" . $e->getMessage();
        }
    }
    else {$errmsg = "This record already exists and will not be overwritten unless you check the box.";}
}

// if it does not exist, add it 
else {
    try {
        echo "Inserting new record";
        $query = "INSERT INTO student_registrations (umid, first_name, last_name, project_name, email_address, phone_number, seat) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = $db->prepare($query);
        $statement->execute([$umid, $first_name, $last_name, $project_name, $email_address, $phone_number, $seat]);
        echo "Successfully inserted new record.";
    } catch (PDOException $e) {
        echo "DataBase Error <br>" . $e->getMessage();
    } catch (Exception $e) {
        echo "General Error <br>" . $e->getMessage();
    }

    $_POST = array();
    header("Location: index.php");
}
