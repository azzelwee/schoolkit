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
                    <h2>Edit Applicant</h2>
                    <p></br>You are editing applicant: <?php echo $row['first_name'] . ' ' .
                     $row['middle_name'] . ' ' . $row['last_name']; ?></br>&nbsp</p>
                    <div class="lineup1 form-page">
                        <div class="column">
                        <div class="form-group" style="width: 900px;">
                                <label for="position">Position Type:</label>
                                <select id="position" name="position_type" onchange="handlePositionChange()">
                                    <option value=""></option>
                                    <option value="Teaching"<?php if ($row['position_type'] == 'Teaching') echo ' selected'; ?>>Teaching</option>
                                    <option value="Non-Teaching"<?php if ($row['position_type'] == 'Non-Teaching') echo ' selected'; ?>>Non-Teaching</option>
                                </select>

                                
                                <div id="teachingInputDiv" class="hidden">
                                    <label for="teachingInput">Teaching Positions:</label>
                                    <select id="teachingInput" name="teachingInput">
                                        <option value="">-- Select Subject-Specific Teaching --</option>
                                        <option value="Mandarin">Mandarin</option>
                                        <option value="Communications">Communications</option>
                                        <option value="Accounting">Accounting</option>
                                        <option value="Physical Education">Physical Education</option>
                                        <option value="Accounting Research Methods">Accounting Research Methods</option>
                                        <option value="Math, Science & Technology">Math, Science & Technology</option>
                                        <option value="Computer Science">Computer Science</option>
                                    </select>
                                </div>
                                
                                <div id="nonTeachingInputDiv" class="hidden">
                                    <label for="nonTeachingInput">Non-teaching Positions:</label>
                                    <select id="nonTeachingInput" name="nonTeachingInput">
                                        <option value="">-- Select Non-Teaching Positions --</option>
                                        <option value="Administration">Administration</option>
                                        <option value="Counseling and Support">Counseling and Support</option>
                                        <option value="Library and Media">Library and Media</option>
                                        <option value="Maintenance and Operations">Maintenance and Operations</option>
                                        <option value="Office and Clerical">Office and Clerical</option>
                                        <option value="Health and Wellness">Health and Wellness</option>
                                    </select>
                                </div>

                                <label for="">Select Status</label>
                                <select name="status">
                                        <option value="Pending">Pending</option>
                                        <option value="Pooling List">Pooling List</option>
                                        <option value="Qualified">Qualified</option>
                                        <option value="Hired">Hired</option>
                                    </select>

                            </div>
                        </div>
                    </div>
                
                </div>
                
                <button type="button" class="thebutton" onclick="nextSection('section1', 'section2')">Next</button>
                
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