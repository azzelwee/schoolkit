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
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- left container -->
<div class="left-container">
    <h4>Main Navigation</h4></br>
        <ul class="category-list">
            <li><img src="img/dashboard.png" alt=""><a href="dashboard.php">Dashboard</a></li>


            <li><img src="img/structure.png" alt=""><a href="#">Maintenance</a></li>


            <li><img src="img/exit.png" alt=""><a href="logout.php">Logout</a></li>  


        </ul> 
    </div>
<!-- end of left container -->

    
</body>
<script src="js/main.js"></script>
</html>