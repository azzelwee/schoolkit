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
        <h2>Employee Reports</h2>
        <div class="gauge-line"></div>
        <form action="result.php" method="get">
            <div class="search">
                <img src="img/search.png" class="search-icon">
                <input class="search-input" name="search" placeholder="Search an Employee">
            </div>
        </form>

        <!-- Attendance Reports Button -->
        <button id="attendanceReportsBtn">
            Attendance Reports
        </button>

                <!-- Leave Reports Button -->
                <button id="leaveReportsBtn">
            Leave Reports
        </button>

        <!-- Attendance Reports Header and Table -->
        <h3 id="attendanceHeader" style="display: block;">Attendance Reports</h3> <!-- Header -->
        <div id="attendanceTable" style="display: block;">
            <table id="table3">
        <thead>
            <tr>
                <th></th>
                <th>Employee ID</th>
                <th>Full Name</th>
                <th>Position</th>
                <th>Department</th>
                <th>Today Days</th>
                <th>Days Present</th>
                <th>Days Absent</th>
                <th>Sick Leave</th>
                <th>Comments/Remarks</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        if ($employee->num_rows > 0) {
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
                <td><?php echo $row['employee_type'] ?></td>
                <td><?php echo $row['employee_section'] ?></td>
                <td><?php echo date('t'); ?></td>
                <td><?php echo date('j'); ?></td>
                <td>0</td>
                <td>0</td>
                <td></td>
            </tr>
        <?php 
            } while($row = $employee->fetch_assoc());
        } else {
            echo "<tr><td colspan='10'>No employees found</td></tr>";
        }
        ?>
        </tbody>
    </table>
        </div>

<!-- Leave Reports Header and Table -->
<h3 id="leaveHeader" style="display: none;">Leave Reports</h3> <!-- Header -->
        <div id="leaveTable" style="display: none;">
            <table id="table3">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Department</th>
                        <th>Leave Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Days</th>
                        <th>Status</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example Data, replace with actual data as needed -->
                    <tr>
                        <td>12345</td>
                        <td>John Doe</td>
                        <td>Sales</td>
                        <td>Sick Leave</td>
                        <td>2024-07-10</td>
                        <td>2024-07-15</td>
                        <td>5</td>
                        <td>Approved</td>
                        <td>None</td>
                    </tr>
                    <tr>
                        <td>67890</td>
                        <td>Jane Smith</td>
                        <td>Marketing</td>
                        <td>Vacation</td>
                        <td>2024-07-01</td>
                        <td>2024-07-10</td>
                        <td>10</td>
                        <td>Pending</td>
                        <td>Awaiting Approval</td>
                    </tr>
                </tbody>
            </table>
        </div>

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
<script>
            document.getElementById('attendanceReportsBtn').onclick = function() {
                document.getElementById('attendanceTable').style.display = 'block';
                document.getElementById('leaveTable').style.display = 'none';
                document.getElementById('attendanceHeader').style.display = 'block'; // Show header
                document.getElementById('leaveHeader').style.display = 'none'; // Hide header
            };

            document.getElementById('leaveReportsBtn').onclick = function() {
                document.getElementById('leaveTable').style.display = 'block';
                document.getElementById('attendanceTable').style.display = 'none';
                document.getElementById('leaveHeader').style.display = 'block'; // Show header
                document.getElementById('attendanceHeader').style.display = 'none'; // Hide header
            };
</script>
<script src= js/main.js></script>
</html>