<?php

if ( !isset( $_SESSION ) ) {
    session_start();
}

include_once( 'connections/connection.php' );
$con = connection();

$is_admin = ( isset( $_SESSION[ 'Access' ] ) && $_SESSION[ 'Access' ] == 'administrator' );

$result = $con->query( 'SELECT * FROM employee_users' );
$row_count = $result->num_rows;

$result = $con->query( 'SELECT * FROM employee_list2' );
$nr_of_rows = $result->num_rows;

$result = $con->query( 'SELECT * FROM applicant_list2' );
$applicant_rows = $result->num_rows;

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Dashboard</title>
    <link rel='stylesheet' href='css/style.css'>
</head>

<body>

    <?php include 'header.php';
?>

    <div class='right-container'>
        <div class='box-container'>
            <h2>Dashboard</h2>
            <div class='gauge-line'></div>
            <div class='container-list'>
                <a href='listEmployee.php' class='container-container1'>
                    <img src='img/NBSDashboard.png'>
                    <div class='employed'>
                        <?php
                        echo $nr_of_rows;
                        ?>
                        <div class='employed-text'>
                            Employees
                        </div>
                    </div>
                </a>

                <a href='users.php' class='container-container2'>
                    <img src='img/NBSBlue.png'>
                    <div class='users'>
                        <?php
                        echo $row_count;
                        ?>
                        <div class='user-text'>
                            Users
                        </div>
                    </div>
                </a>

                <a href='apply.php' class='container-container2'>
                    <img src='img/NBSGray.png'>
                    <div class='ssp'>
                        <?php
                        echo $applicant_rows;
                        ?>
                        <div class='ssp-text'>
                            Self-Service Portal</br>
                            for Applicant
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>
    </div>

</body>
<script src=js/main.js></script>

</html>