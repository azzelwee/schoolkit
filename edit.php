<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

$con = connection();
$id = $_GET['ID'];

$sql = "SELECT * FROM employee_list WHERE id = '$id'" ;
$employee = $con->query($sql) or die ($con->error);
$row = $employee->fetch_assoc();

if(isset($_POST['submit'])){

    $fname = $_POST['fullname'];
    $email = $_POST['email'];
    $dprtment = $_POST['departments'];

    $sql = "UPDATE employee_list SET full_name = '$fname', contact_information = '$email', department = '$dprtment' WHERE id = '$id'";

    $con->query($sql) or die ($con->error);
    echo header("Location: employee.php");

    if($con){
        $_SESSION['status-edit'] = "Data Edited Successfully";
        header('Location: listEmployee.php');
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
    <title>Edit</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body id="<?php echo $id ?>">

    <div class="header">
        <div class="side-nav">
            <a href="#"class="logo">
                <img src="img/nbswhite.png" class="logo-img">
            </a>
            <ul class="nav-links">
                <li><a href="dashboard.php"><img src="img/dashboard.png" class="imgs"><p>Dashboard</p></a></li>
                <li><a href="#"><img src="img/structures.png"><p>Maintenance</p></a></li>
                <li><a href="employee.php"><img src="img/groups.png"><p>Employee</p></a></li>
                <li><a href="#"><img src="img/settings.png"><p>Settings</p></a></li>
                <?php if(isset($_SESSION['UserLogin'])){?>
                    <li><a href="logout.php"><img src="img/out.png"><p>Logout</p></a></li>
                    <?php } else {?>

                    <li><a href="login.php"><img src="img/out.png"><p>Login</p></a></li>
                <?php } ?>

                <div class="active">
                </div>
            </ul>

    </div>

    <div class="right-container">
    <h2>Edit Employee</h2></br>
        <form action="employee.php" method="get">
            <div class="search">
                <img src="img/search.png" class="search-icon">
                <input class="search-input" name="search" placeholder="Search">
            </div>
        </form>


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
    </div>


</body>
</html>