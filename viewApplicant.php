<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

$con = connection();
$id = $_GET['ID'];

$sql = "SELECT * FROM applicant_list2 WHERE id = '$id'";
$employee = $con->query($sql) or die ($con->error);
$row = $employee->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Overview</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body id="<?php echo $id ?>">

<?php include 'header.php'; ?>

<div class="right-container">
    <div class="box-container">
        <div class="view-form">
            <h2>Applicant Profile Overview</h2>
            <div class="profile-section">
                <h3>Personal Information</h3>
                <p><strong>First Name:</strong> <?php echo $row['first_name']; ?></p>
                <p><strong>Middle Name:</strong> <?php echo $row['middle_name']; ?></p>
                <p><strong>Last Name:</strong> <?php echo $row['last_name']; ?></p>
                <!-- <p><strong>Age:</strong> </p>
                <p><strong>Gender:</strong> </p>
                <p><strong>Civil Status:</strong></p>
                <p><strong>Citizenship:</strong> </p>
                <p><strong>Religion:</strong> </p>
                <p><strong>Birthdate:</strong> </p>
                <p><strong>Place of Birth:</strong> </p>
                <p><strong>Height:</strong>  cm</p>
                <p><strong>Weight:</strong>  lbs</p> -->
            </div>

            <div class="profile-section">
                <h3>Contact Information</h3>
                <p><strong>Email:</strong> </p>
                <p><strong>Mobile Number:</strong> </p>
                <p><strong>Telephone Number:</strong> </p>
                <p><strong>Address:</strong> </p>
                <p><strong>City:</strong> </p>
                <p><strong>State/Province:</strong> </p>
                <p><strong>Postal Code:</strong></p>
                <p><strong>Country:</strong></p>
            </div>

            <div class="profile-section">
                <h3>Position and Status</h3>
                <p><strong>Position Type:</strong> </p>
                <p><strong>Status:</strong> </p>
            </div>

            <div class="profile-section">
                <h3>Education</h3>
                <p><strong>Highest Education Attainment:</strong> </p>
                <p><strong>School Name:</strong> </p>
                <p><strong>Course/Program:</strong></p>
                <p><strong>Year Graduated:</strong> </p>
                <p><strong>Honors/Awards Received:</strong> </p>
            </div>

            <div class="profile-section">
                <h3>Training (optional)</h3>
                <p><strong>Training Program:</strong> </p>
                <p><strong>Institution/Organization:</strong> </p>
                <p><strong>Location:</strong></p>
                <p><strong>Date Started:</strong> </p>
                <p><strong>Date Completed:</strong> </p>
                <p><strong>Certificate Received:</strong></p>
                <p><strong>Skills Acquired:</strong></p>
            </div>

            <div class="profile-section">
                <h3>Work Experience</h3>
                <p><strong>Previous Job Title:</strong> </p>
                <p><strong>Company Name:</strong> </p>
                <p><strong>Responsibilities and Achievements:</strong></p>
                <p><strong>Date of Employment:</strong> </p>
                <p><strong>References:</strong></p>
            </div>

            <div class="profile-section">
                <h3>Additional Information</h3>
                <p><strong>Resume/CV:</strong> <a href="uploads/">Download</a></p>
                <p><strong>Work Samples/Portfolio:</strong> <a href="uploads/">Download</a></p>
                <p><strong>Certificates:</strong> <a href="uploads/">Download</a></p>
                <p><strong>Questions/Comments:</strong> </p>
            </div>
        </div>
    </div>
</div>

<script src="js/main.js"></script>

</body>
</html>
