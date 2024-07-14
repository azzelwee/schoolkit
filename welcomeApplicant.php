<?php

if(!isset($_SESSION)){
    session_start();
}

// $nr_of_rows = $_SESSION['nr_of_rows']; 
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


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="right-container">
    <div class="box-container">
            <h1>Welcome to NBS College!</h1>
            <div class="gauge-line"></div>

            <?php
            if(isset($_SESSION['status-add'])){
            ?>
            <div class="status-add" id="statusPopup">
                <?php echo $_SESSION['status-add']; ?>
                <span class="close-btn" onclick="closePopup();">&times;</span>
            </div>
            <?php
            unset($_SESSION['status-add']);
        }?>
            <img src="img/nbspic.png" class="school">

        </div>
    </div>
                
            </div>
        </div>
    </div>

    <footer>
    &copy; 2024 NBS College. If you have any questions or concerns, please contact us.
    Email: info@nbscollege.edu.ph
    Contact Number:(02) 8376-5090, 0917-8076850, 0961-3826332
    </footer>

    
</body>
<script src= js/main.js></script>
</html>