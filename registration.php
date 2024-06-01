<?php

if(!isset($_SESSION)){
    session_start();
}

// $is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");
// $is_user = (isset($_SESSION['Access']) && $_SESSION['Access'] == "user");


include_once("connections/connection.php");
$con = connection();

if(isset($_POST['submit'])){

    $fname = $_POST['first_name'];
    $mname = $_POST['middle_name'];
    $lname = $_POST['last_name'];
    $uname = $_POST['username'];
    $pword = $_POST['password'];
    $access = $_POST['access'];

    $sql = "INSERT INTO `employee_users`(`first_name`, `middle_name`, `last_name`, `username`, `password`, `access`)
    VALUES ('$fname', '$mname', '$lname', '$uname','$pword','$access')";

    $con->query($sql) or die ($con->error);
    // $query_run = mysqli_query($con, $query)
    // echo header("Location: employee.php");

    if($con){
        // $_SESSION['status-add'] = "Data Added Successfully";
        header('Location: index.php');
    } else{
        echo "Something went wrong";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Add</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body id="formlogin">
    <div class="login-container">
    <br/>
        <div class="form-logo">
            <!-- <img src="img/nbsclogo.png" alt=""> -->
            <h1>Register</h1>
            <div class="form-container2">

        <form id="registrationForm" onsubmit="return validateForm()" method="post" action="">

        <label for="">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" required>

        <label for="">Middle Name:</label><br>
        <input type="text" id="middle_name" name="middle_name" required>
        
        <label for="">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" required>
        
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required>

        <select name="access" style="display: none;">
            <option value="user">User</option>
        </select>
        
        <label for="confirm-password">Confirm Password:</label><br>
        <input type="password" id="confirm-password" required><br>
        <span id="passwordError" class="confirmpasserror">Passwords do not match</span>
        
        <input type="checkbox" id="consent" required>
        <label for="consent">I agree to the <a href="">
            Terms of Service</a> and <a href="">Privacy Policy</a></label>
        
        <input type="submit" name="submit" value="Register">


                </form>
            </div>
        </div>
    </div>  

</body>
<script src="js/main.js"></script>
</html>