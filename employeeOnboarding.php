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

$sql = "SELECT * FROM applicant_list2 ORDER BY ID DESC LIMIT $start, $rows_per_page";
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
        <h2>Applicant Processing</h2>
        <div class="gauge-line"></div>
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

        <table id="table2">
        <thead>
        <tr>
            <th></th>
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
                <td><a href="viewApplicant.php?ID=<?php echo $row['ID'];?>">
                <button style="font-size: 12px; padding: 5px 10px; background-color: #d52033; color: white; border: none; border-radius: 4px; cursor: pointer;">View</button>
                </a></td>

                <td><?php echo $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']; ?></td>
                <td><?php echo $row['position_type'];?></td>
                <td style="color: <?php
                    $status = $row['status'];
                    if ($status == 'Pending') {
                        echo '';
                    } elseif ($status == 'Pooling List') {
                        echo '';
                    } elseif ($status == 'Qualified') {
                        echo '';
                    } elseif ($status == 'Hired') {
                        echo '';
                    }
                    ?>;"><?php echo $status; ?></td>
                <td>
                <!-- Edit Icon -->
                <a href="editApplicant.php?ID=<?php echo $row['ID']; ?>" class="icon-link">
                    <img src="img/edit.png" alt="Edit">
                </a>

                <!-- Delete Button -->
                <form action="deleteApplicant.php" method="POST" class="icon-link" onsubmit="return confirmDeletion()">
                    <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
                    <button type="submit" name="delete" class="icon-button">
                        <img src="img/delete.png" alt="Delete">
                    </button>
                </form>
                </td>
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