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
    <form action="your_action_page.php" method="post">
        <label for="employee_name" class="info-text">Select an employee:</label>
        <?php
        // Assuming $con is your mysqli connection
        $sql = "SELECT first_name, middle_name, last_name FROM employee_list2 ORDER BY id";
        $employee = $con->query($sql) or die($con->error);

        echo '<select name="employee_name" id="employee_name" class="styled-select" onchange="updateEmployeeName()">';
        echo '<option value="" selected disabled>Select an employee</option>'; // Placeholder option

        while($row = $employee->fetch_assoc()) {
            $firstName = htmlspecialchars($row['first_name']);
            $middleName = htmlspecialchars($row['middle_name']);
            $lastName = htmlspecialchars($row['last_name']);
            $fullName = "$firstName $middleName $lastName";
            echo "<option value='$fullName'>$fullName</option>";
        }

        echo '</select>';
        ?>
        <!-- <input type="submit" value="Submit"> -->
    </form>

    <div id="employee_details">
        <p>Employee Name: <span id="employee_full_name"></span></p>
    </div>
    
        </div>
    </div>

    
</body>
<script src= js/main.js></script>
</html>