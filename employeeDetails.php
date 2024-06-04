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

<div class="right-container-add">
        <div class="box-container">
            <h2>Employee Profile Overview</h2><br>
            <div class="gauge-line"></div>

            <div class="employee-picture-details">
                <div class="employee-details">
                    <div class="employee-details-name">
                        <p><?php echo $row['last_name'] . ', ' . $row['first_name'] . ' ' . $row['middle_name']; ?></p>
                    </div>
                    <form action="delete.php" method="post">
                        <div class="button-container-delete-edit">
                            <?php if ($_SESSION['Access'] == "administrator") { ?>
                            <a href="editEmployee.php?ID=<?php echo $row['ID']; ?>">Update Information</a>
                            <button type="submit" name="delete" class="button-danger-delete-edit">Delete</button>
                            <?php } ?>
                        </div>
                        <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
                    </form>
                </div>
                <div class="employee-picture-frame">
                    <div class="employee-picture">
                        <?php
                            $imagePath = $row['file_path'];
                            $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
                            $fileExtension = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
                            $isImage = in_array($fileExtension, $allowedFormats);
                            if ($isImage) {
                                echo '<img src="' . $imagePath . '" alt="Uploaded Image" style="width: 150px; height: 150px;">';
                            } else {
                                echo '<div style="color: black; text-align: left; margin-bottom: 10px; margin-right: 50px;">There is no uploaded image.</div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            </br>
            <div class="employee-information">
                <!-- <h2>Employee Information</h2>
                <p>Status: <span style="color: <?php echo ($row['employee_status'] == 'Hired') ? 'green' : 'red'; ?>;"><?php echo $row['employee_status']; ?></span> &emsp;&emsp;Date Hired:</p> -->


                <div class="add-form">
        <form action="" method="post" enctype="multipart/form-data" class="add-employee-form">
        <div id="section1">
        <h2>Basic Information</h2>
            <div class="form-page">
                <div class="column">

                <div class="form-group ">
                        <label for="employee-first-name">First Name:</label>
                        <input type="text" id="employee-first-name" name="first_name" value="<?php echo $row['first_name'];?>" class="custom-disabled" disabled>
                    </div>
                    
                    <div class="form-group small">
                        <label for="employee-middle-name">Middle Name:</label>
                        <input type="text" id="employee-middle-name" name="middle_name" value="<?php echo $row['middle_name'];?>" class="custom-disabled" disabled>
                    </div>

                    <div class="form-group small">
                        <label for="employee-last-name">Last Name:</label>
                        <input type="text" id="employee-last-name" name="last_name" value="<?php echo $row['last_name'];?>" class="custom-disabled" disabled>
                    </div>

                    <div class="form-group small ">
                        <label for="employee-age">Age:</label>
                        <input type="number" id="employee-age" name="age" value="<?php echo $row['age'];?>" class="custom-disabled" disabled>
                    </div>

                    <div class="form-group small">
                        <label for="employee-gender">Gender:</label>
                        <select id="employee-gender" name="gender" class="custom-disabled" disabled>
                            <option value="gender"><?php echo $row['gender']; ?></option>
                        </select>
                    </div>


                    <div class="form-group small">
                        <label for="employee-civil-status">Civil Status:</label>
                        <select id="employee-civil-status" name="civil_status" disabled>
                            <option value=""><?php echo $row['civil_status'];?></option>
                        </select>
                    </div>

                    <div class="form-group small">
                        <label for="employee-citizenship">Citizenship:</label>
                        <input type="text" id="employee-citizenship" name="citizenship" value="<?php echo $row['citizenship'];?>" class="custom-disabled" disabled>
                    </div>

                    <div class="form-group small">
                        <label for="employee-religion">Religion:</label>
                        <input type="text" id="employee-religion" name="religion" value="<?php echo $row['religion'];?>" class="custom-disabled" disabled>
                    </div>  

                    <div class="form-group small">
                        <label for="employee-birthdate">Birthdate:</label>
                        <input type="date" id="employee-birthdate" name="birthdate" value="<?php echo $row['birthdate'];?>" class="custom-disabled" disabled>
                    </div>

                    <div class="form-group ">
                        <label for="employee-birthplace">Place of Birth:</label>
                        <input type="text" id="employee-birthplace" name="place_of_birth" value="<?php echo $row['place_of_birth'];?>" class="custom-disabled" disabled>
                    </div>

                    <div class="form-group small">
                        <label for="employee-height">Height (cm):</label>
                        <input type="number" id="employee-height" name="height" value="<?php echo $row['height'];?>" class="custom-disabled" disabled>
                    </div>

                    <div class="form-group small">
                        <label for="employee-weight">Weight (lbs.):</label>
                        <input type="number" id="employee-weight" name="weight" value="<?php echo $row['weight'];?>" class="custom-disabled" disabled>
                    </div>

        <!-- <div class="form-group-below">
            <h2>Below</h2>
                    <div class="column">
                        asdasdasd  
                    </div>
        </div> -->

                </div>
            </div>

        <button type="button" class="thebutton" onclick="nextSection('section1', 'section2')">Next</button>
        </div>
    
        <div id="section2" style="display: none;">
        <h2>Contact Information</h2>
            <div class="column">
            <div class="form-group small">
                            <label for="employee-citizenship">Email:</label>
                            <input type="text" id="employee-citizenship" name="employee-citizenship">
                        </div>
                        
                        <div class="form-group small">
                            <label for="employee-citizenship">Mobile Number:</label>
                            <input type="text" id="employee-citizenship" name="employee-citizenship">
                        </div>

                        <div class="form-group small">
                            <label for="employee-citizenship">Telephone Number:</label>
                            <input type="text" id="employee-citizenship" name="employee-citizenship">
                        </div>
                        <div class="form-group ">
                            <label for="employee-citizenship">Address:</label>
                            <input type="text" id="employee-citizenship" name="employee-citizenship">
                        </div>

                        <div class="form-group small">
                            <label for="employee-citizenship">City:</label>
                            <input type="text" id="employee-citizenship" name="employee-citizenship">
                        </div>
                        <div class="form-group small">
                            <label for="employee-citizenship">State/Province:</label>
                            <input type="text" id="employee-citizenship" name="employee-citizenship">
                        </div>
                        <div class="form-group small">
                            <label for="employee-citizenship">Postal Code:</label>
                            <input type="text" id="employee-citizenship" name="employee-citizenship">
                        </div>
                        <div class="form-group small">
                            <label for="employee-citizenship">Country:</label>
                            <input type="text" id="employee-citizenship" name="employee-citizenship">
                        </div>

                        
                    <!-- <div class="form-group-below">
                        <h2>Below</h2>
                        <div class="column">
                            vvvv
                        </div>
                    </div> -->
                    
                </div>
            <button type="button" class="thebutton2" onclick="prevSection('section2', 'section1')">Back</button>
            <button type="button" class="thebutton" onclick="nextSection('section2', 'section3')">Next</button>
    </div>

        <div id="section3" style="display: none;">
        
        <h2>Education</h2>
        <div class="lineup1">
            <div class="column">
            <div class="form-group small">
                        <label for="employee-civil-status">Highest Education Attainment:</label>
                        <select id="educ_attain" name="educ_attain">
                            <option value="">Select</option>
                            <option value="single">Elementary</option>
                            <option value="married">High School</option>
                            <option value="divorced">Vocational/Technical</option>
                            <option value="widowed">College/Bachelor's Degree</option>
                            <option value="widowed">Doctorate Degree</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="employee-citizenship">School Name:</label>
                        <input type="text" id="school_name" name="school_name">
                    </div>
                    <div class="form-group small">
                        <label for="employee-citizenship">Course/Program:</label>
                        <input type="text" id="course" name="course">
                    </div>

                    <div class="form-group small">
                        <label for="employee-birthdate">Year Graduated:</label>
                        <input type="date" id="year_grad" name="year_grad">
                    </div>

                    <div class="form-group small">
                        <label for="employee-birthdate">Honors/Awards Received (if applicable):</label>
                        <input type="text" id="honors" name="honors">
                    </div>

                    <div class="form-group-below">
                        <h2>Training (if applicable)</h2>

                    <div class="column">
                        <div class="form-group small">
                            <label for="employee-citizenship">Training Program:</label>
                            <input type="text" id="training_prog" name="training_prog">
                        </div>
                        
                        <div class="form-group small">
                            <label for="employee-citizenship">Institution/Organization:</label>
                            <input type="text" id="institution" name="institution">
                        </div>

                        <div class="form-group">
                            <label for="employee-citizenship">Location:</label>
                            <input type="text" id="loc" name="loc">
                        </div>
                        <div class="form-group small">
                            <label for="employee-citizenship">Date Started:</label>
                            <input type="date" id="data_start" name="data_start">
                        </div>

                        <div class="form-group small">
                            <label for="employee-citizenship">Date Completed:</label>
                            <input type="date" id="data_complete" name="data_complete">
                        </div>

                        <div class="form-group small">
                            <label for="employee-civil-status">Certificate Received:</label>
                            <select id="cert" name="cert">
                                <option value=""></option>
                                <option value="single">Yes</option>
                                <option value="married">No</option>
                            </select>
                        </div>

                        <div class="form-group small">
                            <label for="employee-citizenship">Skills Acquired:</label>
                            <input type="text" id="wide" name="skills_aquired" >
                        </div>
                    </div>
                        </div>
                    </div>
                    <button type="button" class="thebutton2" onclick="prevSection('section3', 'section2')">Back</button>
                    <button type="button" class="thebutton" onclick="nextSection('section3', 'section4')">Next</button>
                </div>
                
                <div id="section4" style="display: none;">
                    <h2>Work Experience</h2>
                    <div class="lineup1">
                        <div class="column">
                            <div class="form-group small">
                                <label for="previous-job-title">Previous Job Title:</label>
                                <input type="text" id="previous-job-title" name="previous-job-title">
                            </div>
                            <div class="form-group small">
                                <label for="company-name">Company Name:</label>
                                <input type="text" id="company-name" name="company-name">
                            </div>
                            <div class="form-group small">
                                <label for="responsibilities">Responsibilities and Achievements:</label>
                                <input type="text" id="responsibilities" name="responsibilities">
                            </div>
                            <div class="form-group small">
                                <label for="employment-date">Date of Employment:</label>
                                <input type="date" id="employment-date" name="employment-date">
                            </div>
                            <div class="form-group small">
                                <label for="references">References (optional):</label>
                                <input type="text" id="references" name="references">
                            </div>
                        </div>
                        <div class="form-group-below">
                            <h2>Additional Information</h2>
                            <div class="column">
                                <div class="form-group small">
                                    <label for="resume">Resume/CV:</label>
                                    <input type="file" id="resume" name="resume">
                                </div>
                                <div class="form-group small">
                                    <label for="work-samples">Work Samples/Portfolio (optional):</label>
                                    <input type="file" id="work-samples" name="work-samples">
                                </div>
                                <div class="form-group small">
                                    <label for="certificates">Certificates (optional):</label>
                                    <input type="file" id="certificates" name="certificates">
                                </div>
                                <div class="form-group small">
                                    <label for="questions-comments">Questions/Comments:</label>
                                    <input type="text" id="wide" name="questions-comments">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="thebutton2" onclick="prevSection('section4', 'section3')">Back</button>
                    <input type="submit" class="thebutton" value="Submit" name="submit">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="js/main.js"></script>

</body>
</html>
