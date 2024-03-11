<?php

include_once("connections/connection.php");
$con = connection();

if(isset($_POST['submit'])){

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO `employee_list`(`first_name`, `last_name`,
    `gender`)VALUES ('$fname','$lname','$gender')";

    $con->query($sql) or die ($con->error);

    echo header("Location: index.php");

}

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

<div class="header">
        <div class="side-nav">
            <a href="#"class="logo">
                <img src="img/nbshorizontal.png" class="logo-img">
            </a>
            <ul class="nav-links">
                <li><a href="dashboard.php"><img src="img/dashboard.png" class="imgs"><p>Dashboard</p></a></li>
                <li><a href="#"><img src="img/structures.png"><p>Maintenance</p></a></li>
                <li><a href="employee.php"><img src="img/groups.png"><p>Employee</p></a></li>
                <li><a href="#"><img src="img/settings.png"><p>Settings</p></a></li>
                <li><a href="login.php"><img src="img/out.png"><p>Logout</p></a></li>

                <div class="active">
                </div>
            </ul>

        </div>

    <div class="right-container">
        <h2>Dashboard</h2></br>

        <div class="form-container">

        <form action="" method="post">

            <label>First Name</label>
            <input type="text" name="firstname" id="firstname" required placeholder="Enter First Name">

            <label>Last Name</label>
            <input type="text" name="lastname" id="lastname" required placeholder="Enter First Name">

            <label>Gender</label>
            <select name="gender" id="gender" required>
                <option value="">--select gender--</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>

            <input type="submit" name="submit" value="Submit Form">

        </form>
        </div>

    </div>

</body>
</html>