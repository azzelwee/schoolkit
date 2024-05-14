<?php

if(!isset($_SESSION)){
    session_start();
}

$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");

include_once("connections/connection.php");
$con = connection();



$sql = "SELECT * FROM employee_users ORDER BY id DESC";
$employee = $con->query($sql) or die ($con->error);
$row = $employee->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

        
    <div class="right-container">
        <h2>User Management</h2></br>

        <div class="button-container">
            <a href="addUser.php">Add Users</a>
        </div>

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

        <?php
            if(isset($_SESSION['status-delete'])){
            ?>
            <div class="status-delete" id="statusPopup">
                <?php echo $_SESSION['status-delete']; ?>
                <span class="close-btn" onclick="closePopup();">&times;</span>
            </div>
            <?php
            unset($_SESSION['status-delete']);
        }?>     

        <?php
            if(isset($_SESSION['status-edit'])){
            ?>
            <div class="status-edit" id="statusPopup">
                <?php echo $_SESSION['status-edit']; ?>
                <span class="close-btn" onclick="closePopup();">&times;</span>
            </div>
            <?php
            unset($_SESSION['status-edit']);
        }?>
    
<!-- 
        <div class="button-container">
            <a href="add2.php">Add New</a>
            
        </div> -->
        
        <table>
        <thead>
            
     
        <tr>
            <th></th>
            <th>Username</th>
            <th>Password</th>
            <th>Access Type</th>
        </tr>
        </thead>
        <tbody>
        <?php do{ ?>
        <tr>
            <td>
            <form action="deleteUser.php" method="post">
                <div class="button-container-delete-edit">
                    <?php if ($_SESSION['Access'] == "administrator") { ?>
                    <a href="editUser.php?ID=<?php echo $row['ID']; ?>">Edit</a>
                    <button type="submit" name="delete" class="button-danger-delete-edit">Delete</button>
                    <?php } ?>
                </div>
                <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
            </form>
            </td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['access']; ?></td>
        </tr>
        <?php }while($row = $employee->fetch_assoc()); ?>

        
        </tbody>
    </table>

</body>
<script src= js/main.js></script>
</html>