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
                <div class="cards">
                    <div style="display: flex; align-items: center;">
                    <p style="margin-right: 20px;">SSS ID:</p>
                    <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                    </div>
                    <div style="display: flex; align-items: center;">
                    <p style="margin-right: 20px;">Tin ID:</p>
                    <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                    </div>
                    <div style="display: flex; align-items: center;">
                    <p style="margin-right: 20px;">PAGIBIG ID:</p>
                    <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                    </div>
                    <div style="display: flex; align-items: center;">
                    <p style="margin-right: 20px;">PhilHealth ID:</p>
                    <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                    </div>
                </div>
                </br>
                <h2>Employment History</h2>
                <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Company Name:</p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                </div>
                <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Nature of Business:</p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                </div>
                
                <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Branch Department:</p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                </div>
                <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Position:</p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                </div>
                <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Salary Rate:</p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                </div>
                <div style="display: flex; align-items: center;">
                <p style="margin-right: 82px;">Date Hired:</p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                </div>
                <div style="display: flex; align-items: center;">
                <p style="margin-right: 45px;">Date Separated:</p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                </div>
                <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Reason for leaving:</p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                </div> 
            </div>
        </div>
    </div>
    <div class="for-column2">
        <div id="content-0" class="content">
            <h2>Basic Information</h2>
                <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Age:</p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                </div>
                <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Gender:</p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                </div>
                <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Height(cm):</p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                </div>
                <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Weight(lbs.):</p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                </div>
                <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Birthdate:</p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                </div>
                <div style="display: flex; align-items: center;">
                    <p style="margin-right: 20px;">Place of Birth:</p>
                    <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                </div>

                <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Religion:</p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                </div>
                <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Civil Status:</p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                </div>
                <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Citizenship:</p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
                </div>
        </div>

        <div id="content-1" class="content" style="display:none;">
            <h2>Contact Information</h2>
            <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Full Address: </p>
                <div style="margin-top: 10px; width: 400px; height: 50px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
            </div>
            <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Mobile Number: </p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
            </div>
            <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Telephone Number: </p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
            </div>
            <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Email: </p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
            </div>
        </div>

        <div id="content-2" class="content" style="display:none;">
            <h2>Education Attainment</h2>
            <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Elementary: </p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
            </div>
            <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">High School: </p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
            </div>
            <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Vocational: </p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
            </div>
            <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">College: </p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
            </div>
            <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Course: </p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
            </div>
            <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Achievements: </p>
                <div style="width: 300px; height: 50px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
            </div>
                    </br>
            <h2>Training</h2>
            <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Title: </p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
            </div>
            <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Training Company: </p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
            </div>
            <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Inclusive Dates: </p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
            </div>
            <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Venue: </p>
                <div style="width: 200px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
            </div>
            <div style="display: flex; align-items: center;">
                <p style="margin-right: 20px;">Remarks: </p>
                <div style="width: 300px; height: 50px; border: 1px solid rgba(0, 0, 0, 0.5); background-color: white; border-radius: 4px;"></div>
            </div>
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