<?php

// if(!isset($_SESSION)){
//     session_start();
// }

// if(isset($_SESSION['UserLogin'])){
//     echo "Welcome " .$_SESSION['UserLogin'];
// } else {
//     echo "Welcome Guest";
// }


include_once("connections/connection.php");

$con = connection();
$search = $_GET['search'];

$sql = "SELECT * FROM employee_list2 WHERE first_name LIKE '%$search%' ORDER BY ID DESC";
$employee = $con->query($sql) or die ($con->error);
$row = $employee->fetch_assoc();

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>


    <div class="right-container">
        <div class="box-container">
        
        <h2>Search Results</h2></br>
        <form action="result.php" method="get">
        <div class="search">
            <img src="img/search.png" class="search-icon">
            <input class="search-input" name="search" placeholder="Search">
        </div>
        </form>

        <div class="button-container">
            <a href="addEmployee.php">Add New</a>
        </div>

    <table>
        <thead>
        <tr>
            <th></th>
            <th>Full Name</th>
            <th>Employee Status</th>
        </tr>
        </thead>
        <tbody>
        <?php do{ ?>
        <tr>
            <td><a href="details.php?ID=<?php echo $row['ID'];?>"
            class="button-small">view</a></td>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['employee_status']; ?></td>
        </tr>
        <?php }while($row = $employee->fetch_assoc()); ?>
        </tbody>
    </table>    
        </div>
    
</body>
</html>