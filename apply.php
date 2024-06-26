<?php

if (!isset($_SESSION)) {
    session_start();
}

// $is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");
// $is_user = (isset($_SESSION['Access']) && $_SESSION['Access'] == "user");

include_once("connections/connection.php");
$con = connection();

if(isset($_POST['submit'])) {
    $positiontype = $_POST['position_type'];
    // $position = ($_POST['position'] == 'Teaching') ? $_POST['teachingInput'] : $_POST['nonTeachingInput'];
    $status = $_POST['status'];
    $firstname = $_POST['first_name'];
    $middlename = $_POST['middle_name'];
    $lastname = $_POST['last_name'];

    
    // Handling file uploads (example for resume, repeat for other files)
    $target_dir = "uploads/";
    $target_file_resume = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_resume);

    $sql = "INSERT INTO `applicant_list2` (`position_type`, `status`, `first_name`, `middle_name`, `last_name`) 
    VALUES ('$positiontype', '$status', '$firstname', '$middlename', '$lastname')";
    $con->query($sql) or die ($con->error);

    if($con){
        $_SESSION['status-add'] = "Records Successfully Submitted.";
        header('Location: welcomeApplicant.php');
    } else{
        echo "Something went wrong";
    }
}
    // $stmt = $con->prepare($sql);
    // $stmt->bind_param("ssssissssssssissssssssssssssssssssssssssss", $position_type, $position, $first_name, $middle_name, $last_name, $age, $gender, $civil_status, $citizenship, $religion, $birthdate, $birthplace, $height, $weight, $email, $mobile_number, $telephone_number, $address, $city, $state_province, $postal_code, $country, $highest_education, $school_name, $course_program, $year_graduated, $honors_awards, $training_program, $institution, $location, $training_start, $training_end, $certificate_received, $skills_acquired, $previous_job_title, $company_name, $responsibilities, $employment_date, $references, $resume, $work_samples, $certificates, $comments);
    // $stmt->execute();

    // if ($stmt->affected_rows > 0) {
    //     echo "Data successfully inserted.";
    // } else {
    //     echo "Error: " . $stmt->error;
    // }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="right-container-add">
    <div class="box-container">
        <div class="add-form">
            <form action="" method="post" enctype="multipart/form-data" class="add-employee-form">
                <div id="section1">
                <h1>Welcome to NBS College!</h1>
                <div class="gauge-line"></div>
    </br>
                <h2>What are you applying for?</h2>
                    <div class="lineup1 form-page">
                        <div class="column">
                        <div class="form-group" style="width: 900px;">
                                <label for="position">Employee Type:</label>
                                <select id="position" name="position_type" onchange="handlePositionChange()">
                                    <option value=""></option>
                                    <option value="Teaching">Teaching</option>
                                    <option value="Non-Teaching">Non-Teaching</option>
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

                                    <select name="status" style="display: none;">
                                        <option value="Pending">Pending</option>
                                    </select>

                                </div>
                                <div id="statusInputDiv">
                                    <label for="employementStatus">Employement Status:</label>
                                    <select id="employementStatus" name="employementStatus">
                                        <option value=""></option>
                                        <option value="Full Time">Full Time</option>
                                        <option value="Part Time">Part Time</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-notice">
                        <p>By clicking "Next" and filling out the following form, you agree to provide your personal information. <br>
                        We are committed to protecting your privacy and ensuring the security of your data. <br><br> Your information will be kept confidential and used solely for the purpose stated.
                        <br>We will not share your data with third parties without your explicit consent.
                        <br><br>
                        If you have any questions or concerns about how your information is used, please contact us.
                        <br><br>
                        Email: info@nbscollege.edu.ph
                        <br><br>
                        Contact Number:
                        <br>
                        (02) 8376-5090, 0917-8076850, 0961-3826332
                        </p> 
                    </div>        
                </div>
                
                <button type="button" class="thebutton" onclick="nextSection('section1', 'section2')">Next</button>
                
                <div id="section2" style="display: none;">
                    <h2>Personal Information</h2>
                    <div class="form-page">
                        <div class="column">
                            <div class="form-group">
                                <label for="employee-first-name">First Name:</label>
                                <input type="text" id="employee-first-name" name="first_name">
                            </div>
                            <div class="form-group small">
                                <label for="employee-middle-name">Middle Name:</label>
                                <input type="text" id="employee-middle-name" name="middle_name">
                            </div>
                            <div class="form-group small">
                                <label for="employee-last-name">Last Name:</label>
                                <input type="text" id="employee-last-name" name="last_name">
                            </div>
                            <div class="form-group small">
                                <label for="employee-age">Age:</label>
                                <input type="number" id="employee-age" name="employee-age">
                            </div>
                            <div class="form-group small">
                                <label for="employee-gender">Gender:</label>
                                <select id="employee-gender" name="employee-gender">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group small">
                                <label for="employee-civil-status">Civil Status:</label>
                                <select id="employee-civil-status" name="employee-civil-status">
                                    <option value="">Select Status</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="divorced">Separated</option>
                                    <option value="widowed">Widowed</option>
                                </select>
                            </div>
                            <div class="form-group small">
                                <label for="employee-citizenship">Citizenship:</label>
                                <input type="text" id="employee-citizenship" name="employee-citizenship">
                            </div>
                            <div class="form-group small">
                                <label for="employee-religion">Religion:</label>
                                <input type="text" id="employee-religion" name="employee-religion">
                            </div>  
                            <div class="form-group small">
                                <label for="employee-birthdate">Birthdate:</label>
                                <input type="date" id="employee-birthdate" name="employee-birthdate">
                            </div>
                            <div class="form-group">
                                <label for="employee-birthplace">Place of Birth:</label>
                                <input type="text" id="employee-birthplace" name="employee-birthplace">
                            </div>
                            <div class="form-group small">
                                <label for="employee-height">Height (cm):</label>
                                <input type="number" id="employee-height" name="employee-height">
                            </div>
                            <div class="form-group small">
                                <label for="employee-weight">Weight (lbs.):</label>
                                <input type="number" id="employee-weight" name="employee-weight">
                            </div>
                            <div class="form-group-below">
                                <h2>Contact Information</h2>
                                <div class="column">
                                    <div class="form-group small">
                                        <label for="employee-email">Email:</label>
                                        <input type="email" id="employee-email" name="employee-email">
                                    </div>
                                    <div class="form-group small">
                                        <label for="employee-mobile-number">Mobile Number:</label>
                                        <input type="text" id="employee-mobile-number" name="employee-mobile-number">
                                    </div>
                                    <div class="form-group small">
                                        <label for="employee-telephone-number">Telephone Number:</label>
                                        <input type="text" id="employee-telephone-number" name="employee-telephone-number">
                                    </div>
                                    <div class="form-group">
                                        <label for="employee-address">Address:</label>
                                        <input type="text" id="employee-address" name="employee-address">
                                    </div>
                                    <div class="form-group small">
                                        <label for="employee-city">City:</label>
                                        <input type="text" id="employee-city" name="employee-city">
                                    </div>
                                    <div class="form-group small">
                                        <label for="employee-state">State/Province:</label>
                                        <input type="text" id="employee-state" name="employee-state">
                                    </div>
                                    <div class="form-group small">
                                        <label for="employee-postal-code">Postal Code:</label>
                                        <input type="text" id="employee-postal-code" name="employee-postal-code">
                                    </div>
                                    <div class="form-group small">
                                        &nbsp
                                    </div>
                                    <div class="form-group small">
                                        &nbsp
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="thebutton2" onclick="prevSection('section2', 'section1')">Back</button>
                    <button type="button" class="thebutton" onclick="nextSection('section2', 'section3')">Next</button>
                </div>
                
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
<footer>
    &copy; 2024 NBS College. If you have any questions or concerns, please contact us.
    Email: info@nbscollege.edu.ph
    Contact Number:(02) 8376-5090, 0917-8076850, 0961-3826332
    </footer>

<script src="js/main.js"></script>

</body>
</html>
