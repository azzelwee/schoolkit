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
    // $query_run = mysqli_query($con, $query)
    // echo header("Location: employee.php");

    if($con){
        $_SESSION['status-add'] = "Data Added Successfully";
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
        <form action="" method="post" class="add-employee-form">
                <div id="section1">
                <h2>Add Users</h2>
                <div class="gauge-line"></div>
                    <div class="form-page">
                        <div class="column">
                            <div class="form-group small">
                                <label for="user-first-name">First Name:</label>
                                <input type="text" id="" name="first_name">
                            </div>
                            <div class="form-group small">
                                <label for="user-middle-name">Middle Name:</label>
                                <input type="text" id="" name="middle_name">
                            </div>
                            
                            <div class="form-group small">
                                <label for="user-last-name">Last Name:</label>
                                <input type="text" id="" name="last_name">
                            </div>
                        </div>

                        <div class="column">
                            <div class="form-group">
                                <label for="user-first-name">User Name:</label>
                                <input type="text" id="" name="username">
                            </div>
                        </div>

                        <div class="column">
                            <div class="form-group">
                                <label for="user-middle-name">Password:</label>
                                <input type="text" id="" name="password">
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
                        <input type="submit" class="thebutton" value="Submit" name="submit">
                        
                        </form>

                    </div>
                </div>
        </div>
    </div>


</body>
</html>