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

$sql = "SELECT * FROM employee_list ORDER BY id DESC";
$employee = $con->query($sql) or die ($con->error);
$row = $employee->fetch_assoc();

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
    <div class="left-container">
    <h4>Main Navigation</h4></br>
        <ul class="category-list">
            <li><img src="img/dashboard.png" alt=""><a href="dashboard.php">Dashboard</a></li>
            <li><img src="img/structure.png" alt=""><a href="#">Department</a>
            <li><img src="img/team.png" alt=""><a href="#">Staff</a></li>
            <li><img src="img/redo-arrow.png" alt=""><a href="#">Leave</a></li>
            <li><img src="img/exit.png" alt=""><a href="logout.php">Logout</a></li>  
        </ul> 
    </div>
<!-- end of left container -->

    <div class="right-container">
        <h2>Dashboard</h2></br>

        <div class="container-list">
        <a href="index.php" class="container container1">

        </a>

        <a href="#" class="container container2">

        </a>
            
        <a href="#" class="container container3">

        </a>

        <a href="#" class="container container4">

        </a>

    </div>
    
    </div>
    
    <script src="js/main.js"></script>

</body>
</html>