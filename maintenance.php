<?php

if(!isset($_SESSION)){
    session_start();
}

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

$result = $con->query("SELECT * FROM employee_list2");
$nr_of_rows = $result->num_rows;

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

<?php include 'header.php'; ?>

    <div class="right-container">
    <div class="box-container">
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
</div>
    
</body>
<script src= js/main.js></script>
</html>