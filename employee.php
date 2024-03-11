<?php

if(!isset($_SESSION)){
    session_start();
}

if(isset($_SESSION['UserLogin'])){
    echo "<div class='message success'>Welcome ".$_SESSION['UserLogin'].'</div>';
} else {
    echo "<div class='message info'>Welcome Guest</div>";
}

include_once("connections/connection.php");
$con = connection();

$sql = "SELECT * FROM employee_list ORDER BY id DESC";
$employee = $con->query($sql) or die ($con->error);
$row = $employee->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard 2</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="header">
        <div class="side-nav">
            <a href="#"class="logo">
                <img src="img/nbshorizontal.png" class="logo-img">
            </a>
            <ul class="nav-links">
                <li><a href="dashboard.php"><img src="img/dashboard.png" class="imgs"><p>Dashboard</p></a></li>
                <li><a href="#"><img src="img/structures.png"><p>Maintenance</p></a></li>
                <li><a href="employee.php"><img src="img/groups.png"><p>Employee</p></a></li>
                <li><a href="#"><img src="img/settings.png"><p>Settings</p></a></li>
                <li><a href="login.php"><img src="img/out.png"><p>Logout</p></a></li>

                <div class="active">
                </div>
            </ul>

        </div>

    <div class="right-container">
        
        <h2>Employee List</h2></br>
        <form action="result.php" method="get">
        <div class="search">
            <img src="img/search.png" class="search-icon">
            <input class="search-input" name="search" placeholder="Search">
        </div>
        </form>
        
        
         <table>
        <thead>
        <tr>
            <th></th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
        </thead>
        <tbody>
        <?php do{ ?>
        <tr>
            <td width="30"><a href="details.php?ID=<?php echo $row['id'];?>"
            class="button-small">view</a></td>
            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['last_name']; ?></td>
        </tr>
        <?php }while($row = $employee->fetch_assoc()); ?>
        </tbody>
    </table>

    
    </div>
    
</body>
<script src= js/main.js></script>
</html>