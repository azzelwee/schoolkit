<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();

$sql = "SELECT * FROM employee_users" ;
$employee = $con->query($sql) or die ($con->error);
$row = $employee->fetch_assoc();

if(isset($_POST['submit'])){

    $fname = $_POST['first_name'];
    $mname = $_POST['middle_name'];
    $lname = $_POST['last_name'];
    $uname = $_POST['username'];
    $pword = $_POST['password'];
    $access = $_POST['access'];

    $sql = "UPDATE employee_users SET full_name = '$fullname', username = '$uname', password = '$pword', access = '$access' WHERE ID = '$id'";

    $con->query($sql) or die ($con->error);
    echo header("Location: users.php");

    if($con){
        $_SESSION['status-edit'] = "Data Edited Successfully";
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
    <title>Account Settings</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body id="<?php echo $id ?>">

<?php include 'header.php'; ?>

    <div class="right-container">
        <div class="box-container">
    <h2>Change Your Password</h2></br>
        <div class="form-container">

            <form action="" method="post">

                <label>Username</label>
                <input type="text" name="username" id="username" value="<?php echo $row['username']; ?> "disabled>

                <label>Password</label>
                <input type="text" name="password" id="password" placeholder="Enter Password">

                <label>Confirm Password</label>
                <input type="text" name="password" id="password" placeholder="Enter Password">

            </form>
        </div>
        <input type="submit" class="thebutton" name="submit" value="Edit">
    </div>
    
    </div>
    <footer>
    &copy; 2024 NBS College. If you have any questions or concerns, please contact us.
    Email: info@nbscollege.edu.ph
    Contact Number:(02) 8376-5090, 0917-8076850, 0961-3826332
    </footer>

</body>
</html>