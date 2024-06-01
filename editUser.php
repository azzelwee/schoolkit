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

    $fullname = $_POST['full_name'];
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
    <title>Edit</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body id="<?php echo $id ?>">

<?php include 'header.php'; ?>

    <div class="right-container">
        <div class="box-container">
    <h2>Edit User</h2></br>

            <form action="deleteUser.php" method="post">
                <div class="button-container-delete-edit">
                    <button type="submit" name="delete" class="button-danger-delete-edit">Delete</button>
                </div>
                <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
            </form>


        <div class="form-container">

            <form action="" method="post">

                <label>Full Name</label>
                <input type="text" name="full_name" id="full_name" value="<?php echo $row['full_name']; ?>">

                <label>Username</label>
                <input type="text" name="username" id="username" value="<?php echo $row['username']; ?>">

                <label>Password</label>
                <input type="text" name="password" id="password" placeholder="Enter Password">

                <label>Select Access Type</label>
                <select name="access" required>
                    <option value="">-- select access type --</option>
                    <option value="administrator">Administrator</option>
                    <option value="user">User</option>
                </select>


                <!-- <label>Department</label>
                <select name="department" id="department" required>
                    <option value="">--select department--</option>
                    <option value="test1">test1</option>
                    <option value="test2">test2</option>
                </select> -->

                <input type="submit" class="thebutton" name="submit" value="Edit">

            </form>
        </div>
    </div>
    </div>

</body>
</html>