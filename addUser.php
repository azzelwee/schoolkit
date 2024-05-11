<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();

if(isset($_POST['submit'])){

    $uname = $_POST['username'];
    $pword = $_POST['password'];
    $access = $_POST['access'];

    $sql = "INSERT INTO `employee_users`(`username`, `password`, `access`)VALUES ('$uname','$pword','$access')";

    $con->query($sql) or die ($con->error);
    // $query_run = mysqli_query($con, $query)
    // echo header("Location: employee.php");

    if($con){
        $_SESSION['status-add'] = "Data Added Successfully";
        header('Location: users.php');
    } else{
        echo "Something went wrong";
    }

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
<body">

<?php include 'header.php'; ?>

    <div class="right-container">
    <h2>Add Users</h2></br>

        <div class="form-container">

            <form action="" method="post">

                <label>Username</label>
                <input type="text" name="username" id="username" placeholder="Enter Username">

                <label>Password</label>
                <input type="text" name="password" id="password" placeholder="Enter Password">

                <label>Select Access Type</label>
                <select name="access" required>
                    <option value="">-- select access type --</option>
                    <option value="Administrator">Administrator</option>
                    <option value="User">User</option>
                </select>

                <!-- <label>Department</label>
                <select name="department" id="department" required>
                    <option value="">--select department--</option>
                    <option value="test1">test1</option>
                    <option value="test2">test2</option>
                </select> -->

                
                <input type="submit" value="submit" name="submit" value="Submit Form">

            </form>
        </div>
    </div>


</body>
</html>