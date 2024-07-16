<?php

if(!isset($_SESSION)){
    session_start();
}


$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");

include_once("connections/connection.php");
$con = connection();

$start = 0;
$rows_per_page = 10;

$employee = $con->query("SELECT * FROM employee_list2");
$nr_of_rows = $employee->num_rows;

$pages = ceil($nr_of_rows / $rows_per_page);

if(isset($_GET['page-nr'])){
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
}

$sql = "SELECT * FROM employee_list2 ORDER BY id DESC LIMIT $start, $rows_per_page";
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
    <?php
        if(isset($_GET['page-nr'])){
            $id = $_GET['page-nr'];
        }else {
            $id = 1;
        }

    ?>
<body id="<?php echo $id ?>">

<?php include 'header.php'; ?>

    <?php if ($is_admin): ?>

        
    <div class="right-container">
    <div class="box-container">
        <h2>Employee List</h2>
        <div class="gauge-line"></div>
        <form action="result.php" method="get">
        <div class="search">
            <img src="img/search.png" class="search-icon">
            <input class="search-input" name="search" placeholder="Search an Employee">
        </div>
    </form>
    
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

        <div class="button-container">
            <a href="addEmployee.php">+ Add Employee</a>
        </div>

        <div class="button-container2">
            <a href="employeeRenew.php">Employee Renewal</a>
        </div>



    
        <table id="table4">
    <thead>
        <tr>
        <th></th>
            <th>Employee ID</th>
            <th>Full Name</th>
            <th>Employee Status</th>
            <th>Employee Type</th>
            <th>Section</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    if ($employee->num_rows > 0) { // Check if there are rows in $employee
        do {
    ?>
            <tr>
            <td>
                <a href="employeeDetails2.php?ID=<?php echo $row['ID'];?>#profile">
                <button style="font-size: 12px; padding: 5px 10px; background-color: #d52033; color: white; border: none; border-radius: 4px; cursor: pointer;">View</button>
                </a>
            </td>
                <td><?php echo $row['employee_id'];?></td>
                <td><?php echo $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']; ?></td>
                <td><?php echo $row['employee_status'] ?></td>
                <td><?php echo $row['employee_type'] ?></td>
                
                <!-- <td>
                    <a href="editEmployee.php?ID=<?php echo $row['ID'];?>">
                        <img src="img/edit.png" alt="">
                    </a>
                    &nbsp
                    <a href="details.php?ID=<?php echo $row['ID'];?>">
                        <img src="img/view.png" alt="">
                    </a>

                </td> -->

                <td><?php echo $row['employee_section'] ?></td>

            </tr>
    <?php 
        } while($row = $employee->fetch_assoc()); // Fetch next row
    } else {
        // Handle the case where there are no rows in $employee
        echo "<tr>
            <td colspan='4'>No employees found</td>
            </tr>";
    }
    ?>
    </tbody>
</table>

<!-- pagination -->
    <div class="page-info">
        <?php
            if(!isset($_GET['page-nr'])){
                $page = 1;
            }else{
                $page = $_GET['page-nr'];
            }
        ?>
        Showing <?php echo $page ?> of <?php echo $pages ?> pages
    </div>

    <div class="pagination">
        <!-- <a class="aa" href="?page-nr=1">First</a> -->

        <?php
            if(isset($_GET['page-nr']) && $_GET['page-nr'] > 1){
                ?>
                <a class="aa" href="?page-nr=<?php echo $_GET['page-nr']-1?> ">Previous</a>
                <?php
            }else {
                ?>
                    <a class="aa">Previous</a>
                <?php
            }
        ?>


        <div class="page-numbers">
            <?php
                for($counter = 1; $counter <= $pages; $counter ++){
            ?>
                <a class="aa" href="?page-nr=<?php echo $counter ?>"><?php echo $counter ?></a>
                <?php
                }

            ?>
        </div>

    <?php
        if(!isset($_GET['page-nr'])){
            ?>
            <a class="aa" href="?page-nr=2">Next</a>
            <?php
        } else {
            if($_GET['page-nr'] >= $pages){
                ?>
                <a class="aa">Next</a>
                <?php
            }else {
            ?>
                <a class="aa" href="?page-nr=<?php echo $_GET['page-nr'] +1 ?>">Next</a>
            <?php
        }
            }

        $_SESSION['nr_of_rows'] = $nr_of_rows;
        ?>
        <!-- <a class="aa" href="?page-nr=<?php echo $pages ?>">Last</a> -->

        </div>
    

    </div>
        </div>
    <!-- end of pagination -->
    <?php endif; ?>

</body>
<script src= js/main.js></script>
</html>