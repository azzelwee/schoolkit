<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

$con = connection();
$id = $_GET['ID'];

$sql = "SELECT * FROM applicant_list2 WHERE id = '$id'" ;
$employee = $con->query($sql) or die ($con->error);
$row = $employee->fetch_assoc();

if(isset($_POST['submit'])){

    $positiontype = $_POST['position_type'];
    // $position = ($_POST['position'] == 'Teaching') ? $_POST['teachingInput'] : $_POST['nonTeachingInput'];
    $status = $_POST['status'];
    $firstname = $_POST['first_name'];
    $middlename = $_POST['middle_name'];
    $lastname = $_POST['last_name'];


    $sql = "UPDATE applicant_list2 SET position_type = '$positiontype', `status` = '$status', 
    first_name = '$firstname', middle_name ='$middlename', last_name ='$lastname' WHERE id = '$id'";

    $con->query($sql) or die ($con->error);

    if($con){
        $_SESSION['status-edit'] = "Records Successfully Updated.";
        header('Location: employeeOnboarding.php');
    } else{
        echo "Something went wrong";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body id="<?php echo $id ?>">

<?php include 'header.php'; ?>
<div class="right-container-add">
    <div class="box-container">
        <div class="add-form">
            <form action="" method="post" enctype="multipart/form-data" class="add-employee-form">
                <div id="section1">
                    <h2>Update Applicant Status</h2>
                    <p></br>You are updating applicant: <?php echo $row['first_name'] . ' ' .
                     $row['middle_name'] . ' ' . $row['last_name']; ?></br>&nbsp</p>
                                <div class="lineup1 form-page">
                                    <div class="column">
                                    <div class="form-group" style="width: 900px;">
                                    <label for="position">Applying Position Type:</label>
                                    <select id="position" name="position_type" onchange="handlePositionChange()" style="pointer-events: none; background-color: #f0f0f0;">
                                        <option value=""></option>
                                        <option value="Teaching"<?php echo ($row['position_type'] == 'Teaching') ? ' selected' : ''; ?>>Teaching</option>
                                        <option value="Non-Teaching"<?php echo ($row['position_type'] == 'Non-Teaching') ? ' selected' : ''; ?>>Non-Teaching</option>
                                    </select>



                                    
                                    <div id="teachingInputDiv" class="<?php echo ($row['position_type'] == 'Teaching') ? '' : 'hidden'; ?>">
                                    <label for="teachingInput">Applying Teaching Position:</label>
                                    <select id="teachingInput" name="teachingInput" style="pointer-events: none; background-color: #f0f0f0;">
                                        <option value="">-- Select Subject-Specific Teaching --</option>
                                        <option value="Mandarin" <?php if ($row['employee_type'] == 'Mandarin') echo 'selected'; ?>>Mandarin</option>
                                        <option value="Communications" <?php if ($row['employee_type'] == 'Communications') echo 'selected'; ?>>Communications</option>
                                        <option value="Accounting" <?php if ($row['employee_type'] == 'Accounting') echo 'selected'; ?>>Accounting</option>
                                        <option value="Physical Education" <?php if ($row['employee_type'] == 'Physical Education') echo 'selected'; ?>>Physical Education</option>
                                        <option value="Accounting Research Methods" <?php if ($row['employee_type'] == 'Accounting Research Methods') echo 'selected'; ?>>Accounting Research Methods</option>
                                        <option value="Math, Science & Technology" <?php if ($row['employee_type'] == 'Math, Science & Technology') echo 'selected'; ?>>Math, Science & Technology</option>
                                        <option value="Computer Science" <?php if ($row['employee_type'] == 'Computer Science') echo 'selected'; ?>>Computer Science</option>
                                    </select>

                                </div>

                                <div id="nonTeachingInputDiv" class="<?php echo ($row['position_type'] == 'Non-Teaching') ? '' : 'hidden'; ?>">
                                    <label for="nonTeachingInput">Applying Non-teaching Position:</label>
                                    <select id="nonTeachingInput" name="nonTeachingInput" style="pointer-events: none; background-color: #f0f0f0;">
                                        <option value="">-- Select Non-Teaching Positions --</option>
                                        <option value="Administration" <?php if ($row['employee_type'] == 'Administration') echo 'selected'; ?>>Administration</option>
                                        <option value="Counseling and Support" <?php if ($row['employee_type'] == 'Counseling and Support') echo 'selected'; ?>>Counseling and Support</option>
                                        <option value="Library and Media" <?php if ($row['employee_type'] == 'Library and Media') echo 'selected'; ?>>Library and Media</option>
                                        <option value="Maintenance and Operations" <?php if ($row['employee_type'] == 'Maintenance and Operations') echo 'selected'; ?>>Maintenance and Operations</option>
                                        <option value="Office and Clerical" <?php if ($row['employee_type'] == 'Office and Clerical') echo 'selected'; ?>>Office and Clerical</option>
                                        <option value="Health and Wellness" <?php if ($row['employee_type'] == 'Health and Wellness') echo 'selected'; ?>>Health and Wellness</option>
                                    </select>

                                </div>

                                <label for="">Select Status</label>
                                <select name="status">
                                        <option value="Pending">Pending</option>
                                        <option value="Pooling List">Pooling List</option>
                                        <option value="Qualified">Qualified</option>
                                    </select>

                            </div>
                        </div>
                    </div>
                
                </div>
                
                <input type="submit" class="thebutton" value="Submit" name="submit">
                
                <div id="section2" style="display: none;">
                <h2>Basic Information</h2>
                    <div class="lineup1">
                        <div class="column">
                            <div class="form-group small">
                                <label for="previous-job-title">First Name:</label>
                                <input type="text" id="first_name" name="first_name" value="<?php echo $row['first_name'];?>">
                            </div>
                            <div class="form-group small">
                                <label for="company-name">Middle Name:</label>
                                <input type="text" id="middle_name" name="middle_name" value="<?php echo $row['middle_name'];?>">
                            </div>
                            <div class="form-group small">
                                <label for="responsibilities">Last Name:</label>
                                <input type="text" id="last_name" name="last_name" value="<?php echo $row['last_name'];?>">
                            </div>
                        </div>
                        <div class="form-group-below">
                            <h2>Credentials</h2>
                            <div class="column">
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                <div class="form-group small">
                                    <label for="resume">Resume/CV:</label>
                                    <input type="file" id="resume" name="resume">
                                </div>
                            </form>
                                <div class="form-group small">
                                    <label for="work-samples">Work Samples/Portfolio (optional):</label>
                                    <input type="file" id="work-samples" name="work-samples">
                                </div>
                                <div class="form-group small">
                                    <label for="certificates">Certificates (optional):</label>
                                    <input type="file" id="certificates" name="certificates">
                                </div>

                            </div>
                        </div>
                    </div>
                    <button type="button" class="thebutton2" onclick="prevSection('section2', 'section1')">Back</button>
                    <input type="submit" class="thebutton" value="Submit" name="submit">
                </div>

                <!-- END FILL OUT -->
                
                <div id="section3" style="display: none;">
                    <h2>Education</h2>
                    <div class="column">
                        <div class="form-group small">
                            <label for="employee-education">Highest Education Attainment:</label>
                            <select id="employee-education" name="employee-education">
                                <option value="">Select</option>
                                <option value="elementary">Elementary</option>
                                <option value="high-school">High School</option>
                                <option value="vocational">Vocational/Technical</option>
                                <option value="bachelor">College/Bachelor's Degree</option>
                                <option value="doctorate">Doctorate Degree</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="employee-school-name">School Name:</label>
                            <input type="text" id="employee-school-name" name="employee-school-name">
                        </div>
                        <div class="form-group small">
                            <label for="employee-course">Course/Program:</label>
                            <input type="text" id="employee-course" name="employee-course">
                        </div>
                        <div class="form-group small">
                            <label for="employee-year-graduated">Year Graduated:</label>
                            <input type="date" id="employee-year-graduated" name="employee-year-graduated">
                        </div>
                        <div class="form-group small">
                            <label for="employee-honors">Honors/Awards Received (if applicable):</label>
                            <input type="text" id="employee-honors" name="employee-honors">
                        </div>
                        <div class="form-group-below">
                            <h2>Training (optional)</h2>
                            <div class="column">
                                <div class="form-group small">
                                    <label for="employee-training-program">Training Program:</label>
                                    <input type="text" id="employee-training-program" name="employee-training-program">
                                </div>
                                <div class="form-group small">
                                    <label for="employee-institution">Institution/Organization:</label>
                                    <input type="text" id="employee-institution" name="employee-institution">
                                </div>
                                <div class="form-group">
                                    <label for="employee-training-location">Location:</label>
                                    <input type="text" id="employee-training-location" name="employee-training-location">
                                </div>
                                <div class="form-group small">
                                    <label for="employee-date-started">Date Started:</label>
                                    <input type="date" id="employee-date-started" name="employee-date-started">
                                </div>
                                <div class="form-group small">
                                    <label for="employee-date-completed">Date Completed:</label>
                                    <input type="date" id="employee-date-completed" name="employee-date-completed">
                                </div>
                                <div class="form-group small">
                                    <label for="employee-certificate">Certificate Received:</label>
                                    <select id="employee-certificate" name="employee-certificate">
                                        <option value=""></option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                                <div class="form-group small">
                                    <label for="employee-skills">Skills Acquired:</label>
                                    <input type="text" id="employee-skills" name="employee-skills">
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

<script src= js/main.js></script>

</body>
</html>