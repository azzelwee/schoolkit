<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();

if(isset($_POST['submit'])){

    $fname = $_POST['fullname'];
    $email = $_POST['email'];
    $dprtment = $_POST['departments'];

    $sql = "INSERT INTO `employee_list`(`full_name`, `contact_information`, `department`)VALUES ('$fname','$email','$dprtment')";

    $con->query($sql) or die ($con->error);

    if($con){
        $_SESSION['status-add'] = "Data Added Successfully";
        header('Location: employee.php');
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
    <h2>Employee List</h2></br>
        <form action="result.php" method="get">
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

                <label>Picture 1x1</label>
                <input type="file" id="fileInput" name="fileInput">

                <!-- <label>Department</label>
                <select name="department" id="department" required>
                    <option value="">--select department--</option>
                    <option value="test1">test1</option>
                    <option value="test2">test2</option>
                </select> -->

                <input type="button" id="uploadButton" value="Upload" onclick="uploadFile()">
                <input type="submit" name="submit" value="Submit Form">

            </form>
        </div>
    </div>


</body>
</html>