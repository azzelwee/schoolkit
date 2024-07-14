<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM employee_users WHERE
    username = '$username' AND password = '$password'";
    $user = $con->query($sql) or die ($con->error);
    $row = $user->fetch_assoc();
    $total = $user->num_rows;

    if($total > 0){
        $_SESSION['UserLogin'] = $row['username'];
        $_SESSION['Access'] = $row['access'];
        
        // Redirect based on access level
        if ($row['access'] == "administrator") {
            header("Location: maintenance.php");
        } else if ($row['access'] == "user") {
            header("Location: welcomeApplicant.php");
        }
        exit; // Ensure no further code is executed after redirection
    } else {
        echo "<div class='message warning'> No user found. </div>";
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBSC Employee Management System</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body id="formlogin">
    <div class="login-container">
    <!-- <h2>Welcome!</h2> -->

    <br/>
    <div class="form-logo">
        <img src="img/nbsclogo.png" alt="">
    </div>
    <div id="msg"></div>
    <form action="" method="post" id="myForm">

        <div class="form-element">
            <label>Username</label>
            <input type="username" name="username" id="username" autocomplete="off" 
            placeholder="Enter Username" required>
        </div>

        <div class="form-element">
            <label>Password</label>
            <input type="password" name="password" id="password"
            placeholder="Enter Password" required>
        </div>



        <button type="submit" name="login" id="btn">Login</button>
  

        <!-- <div class="form-dashboard">
            <a href="dashboard.php">Go to Dashboard</a>

        </div> -->
    </form>

    </div>

    <!-- <script src="js/main.js"></script> -->

</body>
</html>