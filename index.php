<?php

include_once("connections/connection.php");

connection();

$host ="localhost";
$username = "root";
$password = "12345";
$database = "employee_system";

$con = new mysqli($host, $username, $password, $database);

if($con->connect_error){
    echo $con->connect_error;
}

$sql = "SELECT * FROM employee_list";
$employee = $con->query($sql) or die ($con->error);
$row = $employee->fetch_assoc();

// do{

//     echo $row['first_name']." ". $row['last_name']." ". "<br/>";
   
// }while($row = $employee->fetch_assoc());
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>

    <style>

        body{
            font-family: "Calibri"
        }

        h1{
            text-align: center;
        }

        table{
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%
        }

        th, td{
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

    </style>


</head>
<body>
    <h1>Employee Management System</h1>
    <br>
    <br>

    <table>
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
        </thead>
        <tbody>
        <?php do{ ?>
        <tr>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['last_name']; ?></td>
        </tr>
        <?php }while($row = $employee->fetch_assoc()); ?>
        </tbody>
    </table>
</body>
</html>