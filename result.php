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

$sql = "SELECT * FROM employee_list WHERE full_name LIKE '%$search%' ORDER BY id DESC";
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
        
        <h2>Search Results</h2></br>
        <form action="result.php" method="get">
        <div class="search">
            <img src="img/search.png" class="search-icon">
            <input class="search-input" name="search" placeholder="Search">
        </div>
        </form>

        <div class="button-container">
            <a href="add2.php">Add New</a>
        </div>

    <table>
        <thead>
        <tr>
            <th></th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Department</th>
        </tr>
        </thead>
        <tbody>
        <?php do{ ?>
        <tr>
            <td><a href="details.php?ID=<?php echo $row['id'];?>"
            class="button-small">view</a></td>
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['contact_information']; ?></td>
            <td><?php echo $row['department']; ?></td>
        </tr>
        <?php }while($row = $employee->fetch_assoc()); ?>
        </tbody>
    </table>

    

    
</body>
</html>