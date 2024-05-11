<?php

if(!isset($_SESSION)){
    session_start();
}

$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");

include_once("connections/connection.php");
$con = connection();

$sql = "SELECT * FROM employee_list2 ORDER BY id DESC";
$employee = $con->query($sql) or die ($con->error);
$row = $employee->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body id="<?php echo $id ?>">

<?php include 'header.php'; ?>

    <div class="right-container">
        <h2>Employee Information</h2></br>
        <form action="result.php" method="get">
        <div class="search">
            <img src="img/search.png" class="search-icon">
            <input class="search-input" name="search" placeholder="Search">
        </form>
    </div>
        
    <form action="delete.php" method="post">
        <div class="button-container">
            
            <?php if($_SESSION['Access'] == "administrator"){?>
            <a href="edit.php?ID=<?php echo $row['ID'];?>">Edit</a>
            <button type="submit" name="delete" class="button-danger">Delete</button>
            <?php } ?>

        </div>

    <input type="hidden" name="ID" value="<?php echo $row['ID'];?>">
    </form>
            </br>
            </br>
        <?php echo $row['first_name'];?>
        </br>
        <?php echo $row['middle_name'];?>
        </br>
        <?php echo $row['last_name'];?>
    </div>

</body>
</html>