<?php

if(!isset($_SESSION)){
    session_start();
}

$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");

include_once("connections/connection.php");
$con = connection();

$start = 0;
$rows_per_page = 10;

$applicantList = $con->query("SELECT * FROM applicant_list2");
$nr_of_rows = $applicantList->num_rows;

$pages = ceil($nr_of_rows / $rows_per_page);

if(isset($_GET['page-nr'])){
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
}

$sql = "SELECT * FROM applicant_list2 ORDER BY id DESC LIMIT $start, $rows_per_page";
$applicantList = $con->query($sql) or die ($con->error);
$row = $applicantList->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Onboarding</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>


<?php if ($is_admin): ?>

<div class="right-container">
    <div class="box-container">
        <h2>Employee Onboarding</h2>

        <table>
    <thead>
        <tr>
            <th>Applicant ID</th>
            <th>Full Name</th>
            <th>Type</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    if ($applicantList->num_rows > 0) { // Check if there are rows in $employee
        do {
    ?>
            <tr>
                <td width="30"><a href="details.php?ID=<?php echo $row['id'];?>" class="button-small">view</a></td>
                <td><?php echo $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']; ?></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
    <?php 
        } while($row = $applicantList->fetch_assoc()); // Fetch next row
    } else {
        // Handle the case where there are no rows in $employee
        echo "<tr>
            <td colspan='4'>No applicants found</td>
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