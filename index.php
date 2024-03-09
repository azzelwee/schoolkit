<?php

include_once("connections/connection.php");

$con = connection();

$sql = "SELECT * FROM employee_list";
$employee = $con->query($sql) or die ($con->error);
$row = $employee->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <h1>Employee Management System</h1>
    < br>
    <br>
    <a href=""></a>

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