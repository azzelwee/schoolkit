<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();

$id = $_GET['ID'];

$sql = "SELECT * FROM employee_users WHERE id = '$id'" ;
$employee = $con->query($sql) or die ($con->error);
$row = $employee->fetch_assoc();

if(isset($_POST['submit'])){

    $fname = $_POST['first_name'];
    $mname = $_POST['middle_name'];
    $lname = $_POST['last_name'];
    $uname = $_POST['username'];
    $pword = $_POST['password'];
    $access = $_POST['access'];

    $sql = "UPDATE employee_users SET
    `first_name` = '$fname',
    `middle_name` = '$mname',
    `last_name` = '$lname',
    `username` = '$uname',
    `password` = '$pword',
    `access` = '$access'
    WHERE ID = '$id'";

    $con->query($sql) or die ($con->error);
    echo header("Location: users.php");

    if($con){
        $_SESSION['status-edit'] = "Records Successfully Updated.";
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
        <title>Edit</title>
        <link rel="stylesheet" href="css/style.css">

    </head>
    <body id="<?php echo $id ?>">

        <?php include 'header.php'; ?>

        <div class="right-container">
            <div class="box-container">
                <form
                    id="add-employee-form"
                    method="post"
                    class="add-employee-form"
                    onsubmit="return validateForm()">
                    <div id="section1">
                        <h2>Edit User</h2>
                        <div class="gauge-line"></div>
                        <div class="form-page">
                            <div class="column">
                                <div class="form-group small">
                                    <label for="user-first-name">First Name:</label>
                                    <input
                                        type="text"
                                        id="user-first-name"
                                        name="first_name"
                                        value="<?php echo $row['first_name'];?>">
                                </div>
                                <div class="form-group small">
                                    <label for="user-middle-name">Middle Name:</label>
                                    <input
                                        type="text"
                                        id="user-middle-name"
                                        name="middle_name"
                                        value="<?php echo $row['middle_name'];?>">
                                </div>
                                <div class="form-group small">
                                    <label for="user-last-name">Last Name:</label>
                                    <input
                                        type="text"
                                        id="user-last-name"
                                        name="last_name"
                                        value="<?php echo $row['last_name'];?>">
                                </div>
                            </div>
                            <div class="column">
                                <div class="form-group">
                                    <label for="username">User Name:</label>
                                    <input
                                        type="text"
                                        id="username"
                                        name="username"
                                        value="<?php echo $row['username'];?>">
                                </div>
                            </div>

                            <div class="column">
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <div class="password-container">
                                        <input
                                            type="password"
                                            id="password"
                                            name="password"
                                            value="<?php echo $row['password'];?>">
                                        <span id="togglePassword" class="eye">&#128065;</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="confirm-password">Confirm Password:</label>
                                    <div class="password-container">
                                        <input
                                            type="password"
                                            id="confirm-password"
                                            value="<?php echo $row['password'];?>"
                                            required="required">
                                        <span id="toggleConfirmPassword" class="eye">&#128065;</span>
                                    </div>
                                    <span id="passwordError" class="confirmpasserror" style="display:none;">Passwords do not match</span>
                                </div>
                            </div>

                            <div class="column">
                                <div class="form-group">
                                    <label>Select Access Level</label>
                                    <select name="access" required="required">
                                        <option value="<?php echo $row['access'];?>"><?php echo $row['access'];?></option>
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