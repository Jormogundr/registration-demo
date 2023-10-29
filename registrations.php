<?php

require("database.php");

// given a seat index from the database, return the associated time slot string
function seatToTimeslotString($idx)
{
    switch ($idx) {
        case 1:
            return "12/5/23, 6:00 PM – 7:00 PM";
        case 2:
            return "12/5/23, 7:00 PM – 8:00 PM";
        case 3:
            return "12/5/23, 8:00 PM – 9:00 PM";
        case 4:
            return "12/6/23, 6:00 PM – 7:00 PM";
        case 5:
            return "12/6/23, 7:00 PM – 8:00 PM";
        case 6:
            return "12/6/23, 8:00 PM – 9:00 PM";
    }
}

try {
    $query = "SELECT * FROM student_registrations";
    $statement = $db->prepare($query);
    $statement->execute();
    $students = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
} catch (PDOException $e) {
    echo "DataBase Error <br>" . $e->getMessage();
} catch (Exception $e) {
    echo "General Error <br>" . $e->getMessage();
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
    <link rel="stylesheet" href="styles/registrations.css">

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
        <h1>View registration records</h1>

        <span>
            <button onclick="window.location.href='index.php';">
                View Registration Form
            </button>
        </span>

        <section>
            <!-- display a table of products -->
            <table id="registrations">
                <tr>
                    <th>UMID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Project Name</th>
                    <th>Email address</th>
                    <th>Phone Number</th>
                    <th>Timeslot</th>
                </tr>
                <?php foreach ($students as $student) : ?>
                    <tr>
                        <td><?php echo $student['umid']; ?></td>
                        <td><?php echo $student['first_name']; ?></td>
                        <td><?php echo $student['last_name']; ?></td>
                        <td><?php echo $student['project_name']; ?></td>
                        <td><?php echo $student['email_address']; ?></td>
                        <td><?php echo $student['phone_number']; ?></td>
                        <td><?php echo seatToTimeslotString($student['seat']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </section>
    </main>

    <aside>
    </aside>
</body>

</html>