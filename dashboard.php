<?php

if(!isset($_SESSION)){
    session_start();
}

if(isset($_SESSION['UserLogin'])){
    echo "<div class='message success'>Welcome ".$_SESSION['UserLogin'].'</div>';
} else {
    echo "<div class='message info'>Welcome Guest</div>";
}

include_once("connections/connection.php");
$con = connection();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard 2</title>
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
        <div class="container-list">
        <a href="teachers.php" class="container container1">

        </a>

        <a href="#" class="container container2">

        </a>
            
        <a href="#" class="container container3">

        </a>

        <a href="#" class="container container4">

        </a>

    </div>
    
    </div>


    </div>
    
</body>
<script src= js/main.js></script>
</html>