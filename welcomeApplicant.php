<?php

if(!isset($_SESSION)){
    session_start();
}

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

<div class="header">
        <div class="side-nav">
            <a href="dashboard.php"class="logo">
                <img src="img/nbswhite.png" class="logo-img">
            </a>
            <ul class="nav-links">
            
                <li><a href="welcomeApplicant.php"><img src="img/home.png" class="imgs"><p>Welcome!</p></a></li>
                <li><a href="apply.php"><img src="img/apply.png" class="imgs"><p>Apply for a Job</p></a></li>

                <div class="active2">
                </div>


                
            </ul>

</div>

<div class="right-container">
    <div class="box-container">
            <h1>Welcome to NBS College!</h1>
            <div class="gauge-line"></div>

            <?php
            if (isset($_SESSION['status-add'])) {
                echo "<p>" . $_SESSION['status-add'] . "</p>";
                if (isset($_SESSION['resume_path'])) {
                    echo '<p><a href="view_pdf.php?file=' . urlencode($_SESSION['resume_path']) . '" target="_blank">Preview Uploaded Resume</a></p>';
                    unset($_SESSION['resume_path']);
                }
                unset($_SESSION['status-add']);
            }
            ?>
            <img src="img/nbspic.png" class="school" style="width: 95%; margin-top: 20px;">

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