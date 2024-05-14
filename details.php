<?php

if(!isset($_SESSION)){
    session_start();
}

$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");

include_once("connections/connection.php");
$con = connection();

if(isset($_GET['ID'])) {

$employee_id = $_GET['ID'];

$sql = "SELECT * FROM employee_list2 WHERE ID = $employee_id";
$employee = $con->query($sql) or die ($con->error);
$row = $employee->fetch_assoc();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>


<div class="right-container-main">
    <div class="for-column1">
        <div class="right-container-details">
            <h2>Profile Overview</h2><br>
            <form action="delete.php" method="post">
                <div class="button-container-delete-edit">
                    <?php if ($_SESSION['Access'] == "administrator") { ?>
                    <a href="editEmployee.php?ID=<?php echo $row['ID']; ?>">Edit</a>
                    <button type="submit" name="delete" class="button-danger-delete-edit">Delete</button>
                    <?php } ?>
                </div>
                <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
            </form>
            
            <div class="employee-picture-frame">
                <div class="employee-picture">
                    <?php
                        $imagePath = $row['file_path'];
                        $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
                        $fileExtension = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
                        $isImage = in_array($fileExtension, $allowedFormats);
                        if ($isImage) {
                            echo '<img src="' . $imagePath . '" alt="Uploaded Image" style="width: 200px; height: 200px;">';
                        } else {
                            echo '<div style="color: black; text-align: left; margin-bottom: 10px;">There is no uploaded image.</div>';
                        }
                    ?>
                </div>
                <p>Name: <?php echo $row['last_name'] . ', ' . $row['first_name'] . ' ' . $row['middle_name']; ?></p>
                
            </div>
                    </br>
            <div class="employee-information">
                <h2>Employee Information</h2>
                <p>Status: <span style="color: <?php echo ($row['employee_status'] == 'Hired') ? 'green' : 'red'; ?>;"><?php echo $row['employee_status']; ?></span> &emsp;&emsp;Date Hired:</p>
                <p>SSS ID:</p>
                <p>Tin ID:</p>
                <p>Pagibig ID:</p>
                <p>PhilHealth ID:</p>
                    </br>
                <h2>Employment History</h2>
                <p>Company Name:</p>
                <p>Nature of Business:</p>
                <p>Branch Department:</p>
                <p>Position:</p>
                <p>Salary Rate:</p>
                <p>Date Hired:</p>
                <p>Date Separated:</p>
                <p>Reason For Leaving:</p>
            
                
            </div>
            
        </div>
    </div>
    <div class="for-column2">
        <div id="content-0" class="content">
            <h2>Basic Information</h2>
                <p>Age:</p>
                <p>Gender:</p>
                <p>Height(cm):</p>
                <p>Weight(lbs.):</p>
                <p>Birthdate:</p>
                <p>Place of Birth:</p>
                <p>Religion:</p>
                <p>Civil Status:</p>
                <p>Citizenship:</p>


        </div>

        
        <div id="content-1" class="content" style="display:none;">
            <h2>Contact Information</h2>
            <p>No.St./Subd.: City: Address:</p>
            <p>Zip Code: Country:</p>
            <p>Mobile Number:</p>
            <p>Telephone Number:</p>
            <p>Email:</p>
        </div>
        <div id="content-2" class="content" style="display:none;">
            <h2>Education Attainment</h2>
            <p>Elementary:</p>
            <p>High School:</p>
            <p>Vocational:</p>
            <p>College:</p>
            <p>Course:</p>
            <p>Achievements:</p>
                    </br>
            <h2>Training</h2>
            <p>Title:</p>
            <p>Training Company:</p>
            <p>Inclusive Dates:</p>
            <p>Venue:</p>
            <p>Remarks:</p>
        </div>
        <div class="navigation-buttons">
            <button id="back-button" onclick="navigate(-1)">Back</button>
            <button id="next-button" onclick="navigate(1)">Next</button>
        </div>
    </div>
</div>


</body>
<script src= js/main.js></script>
</html>