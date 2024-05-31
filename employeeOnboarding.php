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
            <tr>
                <td></td>
                <td><?php echo $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']; ?></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
    </tbody>
    </table>
    </div>
</div>
    
</body>
</html>