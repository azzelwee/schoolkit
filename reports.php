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
    <title>Reports</title>
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

    <div class="right-container">
        <div class="box-container">
        <h2>Reports</h2>
        <div class="gauge-line"></div>
        <div class="container-list">  
            <a href="listEmployee.php" class="container-container1">
                <img src="img/NBSreport1.png">
                    <div class="report1">
                        Employee List
                    </div>
            </a>

            <a href="employeeOnboarding.php" class="container-container2">
                <img src="img/NBSreport2.png">
                <div class="report2">
                    Applicant List
                </div>
                    
            </a>
    </div>
        
    </div>
    </div>

</body>
<script src= js/main.js></script>
</html>