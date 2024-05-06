<?php

if(!isset($_SESSION)){
    session_start();
}


$nr_of_rows = $_SESSION['nr_of_rows']; 
// $nr_of_employee = $nr_of_rows;

// // Check if the user is logged in
// if(isset($_SESSION['UserLogin'])) {
//     // Check if the popup has already been displayed (via cookie)
//     if(!isset($_COOKIE['popup_displayed'])) {
//         // Set a cookie to indicate that the popup has been displayed
//         setcookie('popup_displayed', '1', time() + (86400 * 30), "/"); // Cookie valid for 30 days
//         // Display the popup message
//         $message = "<div class='popup-message success'>Welcome ".$_SESSION['UserLogin'].'</div>';
//     } else {
//         // Popup already displayed, don't show it again
//         $message = "";
//     }
// } else {
//     $message = "<div class='popup-message info'>Welcome Guest</div>";
// }

include_once("connections/connection.php");
$con = connection();

$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");

$result = $con->query("SELECT * FROM employee_users");
$row_count = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="header">
        <div class="side-nav">
            <a href="#"class="logo">
                <img src="img/nbswhite.png" class="logo-img">
            </a>
            <ul class="nav-links">
                <li><a href="dashboard.php"><img src="img/dashboard.png" class="imgs"><p>Dashboard</p></a></li>
                <li><a href="maintenance.php"><img src="img/structures.png"><p>Maintenance</p></a></li>
<!--                
                <?php if ($is_admin): ?>
                <li><a href="employee.php"><img src="img/groups.png"><p>Employee</p></a></li>
                <?php endif; ?>
                 -->
                <li><a href="reports.php"><img src="img/settings.png"><p>Reports</p></a></li>
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
        <h2>Maintenance</h2></br>
        <div class="container-list">  
            <a href="listEmployee.php" class="container-container1">
                <img src="img/NBSDashboard.png">
                    <div class="employed">
                        <?php
                        echo $nr_of_rows;
                        ?>
                        <div class="employed-text">
                            Employees
                        </div>
                    </div>
            </a>

            <a href="users.php" class="container-container2">
                <img src="img/NBSBlue.png">
                    <div class="users">
                        <?php
                        echo $row_count;
                        ?>
                        <div class="user-text">
                        Users
                        </div>
                    </div>
            </a>
        
<!-- 
        <a href="#" class="container-container2">
            <img src="img/NBSblue.png">

        </a>
            
        <a href="#" class="container container3">

        </a>

        <a href="#" class="container container4">

        </a> -->

    </div>
    </div>
    </div>
    
</body>
<script src= js/main.js></script>
</html>