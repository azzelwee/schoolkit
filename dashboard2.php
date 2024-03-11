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
    <!-- <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script> -->
</head>
<body>

    <div class="header">
        <div class="side-nav">
            <a href="#"class="logo">
                <img src="img/nbshorizontal.png" class="logo-img">
            </a>
            <ul class="nav-links">
                <li><a href="#"><img src="img/dashboard.png" class="imgs"><p>Dashboard</p></a></li>
                <li><a href="#"><img src="img/structures.png"><p>Maintenance</p></a></li>
                <li><a href="#"><img src="img/groups.png"><p>Employee</p></a></li>
                <li><a href="#"><img src="img/settings.png"><p>Settings</p></a></li>
                <li><a href="login.php"><img src="img/out.png"><p>Logout</p></a></li>

                <div class="active">


                </div>
            </ul>

        </div>
    


    </div>
    
</body>
</html>