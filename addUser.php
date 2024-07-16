<?php

if(!isset($_SESSION)){
    session_start();
}

$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");

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
    

    if($con){
        $_SESSION['status-add'] = "Records Successfully Submitted.";
        header('Location: users.php');
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
<body">

<?php include 'header.php'; ?>

<div class="right-container">
    <div class="box-container">
        <form id="add-employee-form" method="post" class="add-employee-form" onsubmit="return validateForm()">
            
        <h2>Add Users</h2>
        <div class="gauge-line"></div>
        <div id="section1">
                <div class="form-page">
                    <div class="column">
                        <div class="form-group small">
                            <label for="user-first-name">First Name:</label>
                            <input type="text" id="user-first-name" name="first_name">
                        </div>
                        <div class="form-group small">
                            <label for="user-middle-name">Middle Name:</label>
                            <input type="text" id="user-middle-name" name="middle_name">
                        </div>
                        <div class="form-group small">
                            <label for="user-last-name">Last Name:</label>
                            <input type="text" id="user-last-name" name="last_name">
                        </div>
                    </div>
                    <div class="column">
                        <div class="form-group">
                            <label for="username">User Name:</label>
                            <input type="text" id="username" name="username">
                        </div>
                    </div>
                    <div class="column">
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <div class="password-container">
                                <input type="password" id="password" name="password">
                                <span id="togglePassword" class="eye">&#128065;</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirm-password">Confirm Password:</label>
                            <div class="password-container">
                                <input type="password" id="confirm-password"required>
                                <span id="toggleConfirmPassword" class="eye">&#128065;</span>
                            </div>
                            <span id="passwordError" class="confirmpasserror" style="display:none;">Passwords do not match</span>
                        </div>
                    </div>

                    <div class="column">
                        <div class="form-group">
                            <label>Select Access Level</label>
                            <select name="access" required>
                                <option value=""></option>
                                <option value="administrator">Administrator</option>
                                <option value="applicant">Applicant</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                    <input type="submit" class="thebutton" name="submit" value="Submit">
                </div>
            </div>
        </form>
    </div>
</div>



</body>
<script src="js/main.js"></script>
</html>