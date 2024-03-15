<?php

if(!isset($_SESSION)){
    session_start();
}

// if(isset($_SESSION['Access']) && $_SESSION ['Access'] == "administrator"){
//     echo "<div class='message success'>Welcome " .$_SESSION['UserLogin']. "</div> <br/><br/>";
// } else {
//     echo header("Location: employee.php");
// }

include_once("connections/connection.php");

$con = connection();

$id = $_GET['ID'];

$sql = "SELECT * FROM employee_list WHERE id = '$id'" ;
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
        <h2>Employee Information</h2></br>
        <form action="result.php" method="get">
        <div class="search">
            <img src="img/search.png" class="search-icon">
            <input class="search-input" name="search" placeholder="Search">
        </form>
    </div>
        
    <form action="delete.php" method="post">
        <div class="button-container">
            
            <?php if($_SESSION['Access'] == "administrator"){?>
            <a href="edit.php?ID=<?php echo $row['id'];?>">Edit</a>
            <button type="submit" name="delete" class="button-danger">Delete</button>
            <?php } ?>

        </div>

    <input type="hidden" name="ID" value="<?php echo $row['id'];?>">
    </form>

    <br/>
    <br/>
    <br/>
    <br/>

    <h2><?php echo $row['full_name'];?>
    </br>

    <?php echo $row['contact_information'];?> </h2>
            </br>
    <p>Department:<?php echo $row['department'];?> </p>
    </div>

</body>
</html>