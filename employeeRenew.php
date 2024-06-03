<?php

if(!isset($_SESSION)){
    session_start();
}


include_once("connections/connection.php");
$con = connection();

$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="right-container">
    <div class="box-container">
    <h2>Employee Renewal</h2>
    <div class="gauge-line"></div>
    <form action="your_action_page.php" method="post" class="employee-Renew">
        <label for="employee_name" class="info-text">Select an employee:</label>
        <?php
        // Assuming $con is your mysqli connection
        $sql = "SELECT first_name, middle_name, last_name FROM employee_list2 ORDER BY id";
        $employee = $con->query($sql) or die($con->error);

        echo '<select name="employee_name" id="employee_name" class="styled-select" onchange="updateEmployeeName()">';
        echo '<option value="" selected disabled >Select an employee</option>'; // Placeholder option

        while($row = $employee->fetch_assoc()) {
            $firstName = htmlspecialchars($row['first_name']);
            $middleName = htmlspecialchars($row['middle_name']);
            $lastName = htmlspecialchars($row['last_name']);
            $fullName = "$firstName $middleName $lastName";
            echo "<option value='$fullName'>$fullName</option>";
        }

        echo '</select>';
        ?>
        
    

    <div id="employee_details">
        <p>Employee Name: </p>
    </div>
    
    <div class="field">
        <span id="employee_full_name"></span>
    </div>

    <div class="contractFrom">
        <label for="">Contract Date From:</label>
        <input type="date">
    </div>

    <div class="contractTo">
        <label for="">Contract Date To:</label>
        <input type="date">
    </div>

    <div class="uploadContract">
        <label for="photos">Upload Contract:</label>
            <input type="file" name="" id="">
    </div>
    <input type="submit" value="Submit">
    </form>
        </div>
    </div>

    
</body>
<script src= js/main.js></script>
</html>