<?php

include_once("connections/connection.php");
$con = connection();

if(isset($_POST['submit'])){

    $fname = $_POST['fullname'];
    $email = $_POST['email'];
    $dprtment = $_POST['departments'];

    $sql = "INSERT INTO `employee_list`(`full_name`, `contact_information`, `department`)VALUES ('$fname','$email','$dprtment')";

    $con->query($sql) or die ($con->error);
    echo header("Location: employee.php");

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Add</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

    <div class="form-container">

        <form action="" method="post">

            <label>First Name</label>
            <input type="text" name="fullname" id="fullname" required placeholder="Enter Full Name">

            <label>Email</label>
            <input type="text" name="email" id="email" required placeholder="Enter Email">

            <label>Department</label>
            <input type="text" name="departments" id="departments" required placeholder="Enter Department">


            <!-- <label>Department</label>
            <select name="department" id="department" required>
                <option value="">--select department--</option>
                <option value="test1">test1</option>
                <option value="test2">test2</option>
            </select> -->

            <input type="submit" name="submit" value="Submit Form">

        </form>
    </div>

</body>
</html>