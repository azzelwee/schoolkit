<?php

if(!isset($_SESSION)){
    session_start();
}

$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");

include_once("connections/connection.php");
$con = connection();

if(isset($_POST['submit'])) {
    $employeeID = $_POST['employee_id'];
    $fname = $_POST['first_name'];
    $mname = $_POST['middle_name'];
    $lname = $_POST['last_name'];
    $estatus = $_POST['employee_status'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $civilstatus = $_POST['civil_status'];
    $citizen = $_POST['citizenship'];
    $religion = $_POST['religion'];
    $birthdate = $_POST['birthdate'];
    $placebirth = $_POST['place_of_birth'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile_number'];
    $telephone = $_POST['telephone_number'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state_province'];
    $postal = $_POST['postal_code'];
    $educ = $_POST['educ_attain'];
    $school = $_POST['school_name'];
    $course = $_POST['course'];
    $yearGrad = $_POST['year_grad'];
    $honors = $_POST['honors'];
    $training = $_POST['training_prog'];
    $institution = $_POST['institution'];
    $location = $_POST['loc'];
    $dateStart = $_POST['date_start'];
    $dateComplete = $_POST['date_complete'];
    $cert = $_POST['cert'];
    $skills = $_POST['skills_aquired'];
    $sss = $_POST['sss_id'];
    $tin = $_POST['tin_id'];
    $pagibig = $_POST['pagibig'];
    $phil = $_POST['phil_id'];
    $dateHired = $_POST['date_hired'];
    $prevJob = $_POST['prev_job'];
    $companyName = $_POST['company_name'];
    $responsi = $_POST['responsi'];
    $dateEmploy = $_POST['date_employment'];
    $refer = $_POST['refer'];
    $questions = $_POST['questions'];
    
    // Check if file was uploaded
    if(isset($_FILES["fileToUpload"]["tmp_name"]) && !empty($_FILES["fileToUpload"]["tmp_name"])) {
        // File upload handling
        $target_dir = "img/uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

                // Now, insert into database
                $sql = "INSERT INTO `employee_list2`
                (
                    `employee_id`,
                    `first_name`, 
                    `middle_name`, 
                    `last_name`, 
                    `employee_status`, 
                    `age`,
                    `gender`,
                    `civil_status`,
                    `citizenship`,
                    `religion`,
                    `birthdate`,
                    `place_of_birth`,
                    `height`,
                    `weight`,
                    `email`,
                    `mobile_number`,
                    `telephone_number`,
                    `address`,
                    `city`,
                    `state_province`,
                    `postal_code`,
                    `educ_attain`,
                    `school_name`,
                    `course`,
                    `year_grad`,
                    `honors`,
                    `training_prog`, 
                    `institution`,
                    `loc`,
                    `date_start`,
                    `date_complete`,
                    `cert`,
                    `skills_aquired`,
                    `file_path`,
                    `sss_id`,
                    `tin_id`,
                    `pagibig`,
                    `phil_id`,
                    `date_hired`,
                    `prev_job`,
                    `company_name`,
                    `responsi`,
                    `date_employment`,
                    `refer`,
                    `questions`
                ) 
                VALUES (
                    '$employeeID',
                    '$fname',
                    '$mname',
                    '$lname',
                    '$estatus',
                    '$age', 
                    '$gender',
                    '$civilstatus',
                    '$citizen',
                    '$religion',
                    '$birthdate',
                    '$placebirth',
                    '$height',
                    '$weight',
                    '$email',
                    '$mobile',
                    '$telephone',
                    '$address',
                    '$city',
                    '$state',
                    '$postal',
                    '$educ',
                    '$school',
                    '$course',
                    '$yearGrad',
                    '$honors',
                    '$training',
                    '$institution',
                    '$location',
                    '$dateStart',
                    '$dateComplete',
                    '$cert',
                    '$skills',
                    '$target_file',
                    '$sss',
                    '$tin',
                    '$pagibig',
                    '$phil',
                    '$dateHired',
                    '$prevJob',
                    '$companyName',
                    '$responsi',
                    '$dateEmploy',
                    '$refer',
                    '$questions'
                    )";
                
                $con->query($sql) or die ($con->error);

                if($con){
                    $_SESSION['status-add'] = "Data Added Successfully";
                    header('Location: listEmployee.php');
                } else{
                    echo "Something went wrong";
                }

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // No file uploaded, proceed without uploading
        // Now, insert into database without file path
        $sql = "INSERT INTO `employee_list2`
        (
        `employee_id`,
        `first_name`, 
        `middle_name`, 
        `last_name`, 
        `employee_status`, 
        `age`,
        `gender`,
        `civil_status`,
        `citizenship`,
        `religion`,
        `birthdate`,
        `place_of_birth`,
        `height`,
        `weight`,
        `email`,
        `mobile_number`,
        `telephone_number`,
        `address`,
        `city`,
        `state_province`,
        `postal_code`,
        `educ_attain`,
        `school_name`,
        `course`,
        `year_grad`,
        `honors`,
        `training_prog`, 
        `institution`,
        `loc`,
        `date_start`,
        `date_complete`,
        `cert`,
        `skills_aquired`,
        `sss_id`,
        `tin_id`,
        `pagibig`,
        `phil_id`,
        `date_hired`,
        `prev_job`,
        `company_name`,
        `responsi`,
        `date_employment`,
        `refer`,
        `questions`
        ) 
        VALUES (
            '$employeeID',
            '$fname',
            '$mname',
            '$lname',
            '$estatus',
            '$age', 
            '$gender',
            '$civilstatus',
            '$citizen',
            '$religion',
            '$birthdate',
            '$placebirth',
            '$height',
            '$weight',
            '$email',
            '$mobile',
            '$telephone',
            '$address',
            '$city',
            '$state',
            '$postal',
            '$educ',
            '$school',
            '$course',
            '$yearGrad',
            '$honors',
            '$training',
            '$institution',
            '$location',
            '$dateStart',
            '$dateComplete',
            '$cert',
            '$skills',
            '$sss',
            '$tin',
            '$pagibig',
            '$phil',
            '$dateHired',
            '$prevJob',
            '$companyName',
            '$responsi',
            '$dateEmploy',
            '$refer',
            '$questions'
            )";
        
        $con->query($sql) or die ($con->error);

        if($con){
            $_SESSION['status-add'] = "Data Added Successfully";
            header('Location: listEmployee.php');
        } else{
            echo "Something went wrong";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

    <div class="right-container-add">
        <div class="box-container">
            <!-- <div class="button-containers">
                <a href="">Import from Applicant Processing</a>
            </div> -->
            <h2>Add New Employee</h2>
        <div class="gauge-line"></div>
        <div class="add-form">
            
        <form action="" method="post" enctype="multipart/form-data" class="add-employee-form">
            
        <div id="section1">
        <h2>Basic Information</h2>
            <div class="form-page">
                <div class="column">
                    <div class="form-group ">
                        <label for="employee-first-name">First Name:<span class="required">*</span></label>
                        <input type="text" id="employee-first-name" name="first_name">
                    </div>
                    
                    <div class="form-group small">
                        <label for="employee-middle-name">Middle Name:<span class="required">*</span></label>
                        <input type="text" id="employee-middle-name" name="middle_name">
                    </div>

                    <div class="form-group small">
                        <label for="employee-last-name">Last Name:<span class="required">*</span></label>
                        <input type="text" id="employee-last-name" name="last_name">
                    </div>



                    <div class="form-group small ">
                        <label for="employee-age">Age:<span class="required">*</span></label>
                        <input type="number" id="employee-age" name="age">
                    </div>

                    <div class="form-group small">
                        <label for="employee-gender">Gender:<span class="required">*</span></label>
                        <select id="employee-gender" name="gender">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>


                    <div class="form-group small">
                        <label for="employee-civil-status">Civil Status:<span class="required">*</span></label>
                        <select id="employee-civil-status" name="civil_status">
                            <option value="">Select Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Separated</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>

                    <div class="form-group small">
                        <label for="employee-citizenship">Citizenship:<span class="required">*</span></label>
                        <input type="text" id="employee-citizenship" name="citizenship">
                    </div>

                    <div class="form-group small">
                        <label for="employee-religion">Religion:</label>
                        <input type="text" id="employee-religion" name="religion">
                    </div>  

                    <div class="form-group small">
                        <label for="employee-birthdate">Birthdate:<span class="required">*</span></label>
                        <input type="date" id="employee-birthdate" name="birthdate">
                    </div>

                    <div class="form-group ">
                        <label for="employee-birthplace">Place of Birth:<span class="required">*</span></label>
                        <input type="text" id="employee-birthplace" name="place_of_birth">
                    </div>

                    <div class="form-group small">
                        <label for="employee-height">Height (cm):</label>
                        <input type="number" id="employee-height" name="height">
                    </div>

                    <div class="form-group small">
                        <label for="employee-weight">Weight (lbs.):</label>
                        <input type="number" id="employee-weight" name="weight">
                    </div>



                    <div class="form-group-below">
                        <h2>Contact Information</h2>

                    <div class="column">
                        <div class="form-group small">
                            <label for="employee-citizenship">Email:<span class="required">*</span></label>
                            <input type="text" id="employee-citizenship" name="email">
                        </div>
                        
                        <div class="form-group small">
                            <label for="employee-citizenship">Mobile Number:<span class="required">*</span></label>
                            <input type="text" id="employee-citizenship" name="mobile_number">
                        </div>

                        <div class="form-group small">
                            <label for="employee-citizenship">Telephone Number:</label>
                            <input type="text" id="employee-citizenship" name="telephone_number">
                        </div>
                        <div class="form-group ">
                            <label for="employee-citizenship">Address:<span class="required">*</span></label>
                            <input type="text" id="employee-citizenship" name="address">
                        </div>

                        <div class="form-group small">
                            <label for="employee-citizenship">City:<span class="required">*</span></label>
                            <input type="text" id="employee-citizenship" name="city">
                        </div>
                        <div class="form-group small">
                            <label for="employee-citizenship">State/Province:<span class="required">*</span></label>
                            <input type="text" id="employee-citizenship" name="state_province">
                        </div>
                        <div class="form-group small">
                            <label for="employee-citizenship">Postal Code:<span class="required">*</span></label>
                            <input type="text" id="employee-citizenship" name="postal_code">
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
        <button type="button" class="thebutton" onclick="nextSection('section1', 'section2')">Next</button>
        </div>
    
        <div id="section2" style="display: none;">
        <h2>Education</h2>
                <div class="column">
                <div class="form-group small">
                        <label for="employee-civil-status">Highest Education Attainment:<span class="required">*</span></label>
                        <select id="educ_attain" name="educ_attain">
                            <option value="">Select</option>
                            <option value="Elementary">Elementary</option>
                            <option value="High School">High School</option>
                            <option value="Vocational/Technical">Vocational/Technical</option>
                            <option value="College/Bachelor's Degree">College/Bachelor's Degree</option>
                            <option value="Doctorate Degree">Doctorate Degree</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="employee-citizenship">School Name:<span class="required">*</span></label>
                        <input type="text" id="school_name" name="school_name">
                    </div>
                    <div class="form-group small">
                        <label for="employee-citizenship">Course/Program:<span class="required">*</span></label>
                        <input type="text" id="course" name="course">
                    </div>

                    <div class="form-group small">
                        <label for="employee-birthdate">Year Graduated:<span class="required">*</span></label>
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
                            <input type="date" id="date_start" name="date_start">
                        </div>

                        <div class="form-group small">
                            <label for="employee-citizenship">Date Completed:</label>
                            <input type="date" id="date_complete" name="date_complete">
                        </div>

                        <div class="form-group small">
                            <label for="employee-civil-status">Certificate Received:</label>
                            <select id="cert" name="cert">
                                <option value=""></option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="form-group small">
                            <label for="employee-citizenship">Skills Acquired:</label>
                            <input type="text" id="wide" name="skills_aquired" >
                        </div>
                    </div>

                    </div>
                    
                </div>
            <button type="button" class="thebutton2" onclick="prevSection('section2', 'section1')">Back</button>
            <button type="button" class="thebutton" onclick="nextSection('section2', 'section3')">Next</button>
        </div>

        <div id="section3" style="display: none;">
        
        <h2>Employee Information</h2>
        <div class="lineup1">
            <div class="column">

        <div class="form-group small">
            <label for="">Employee ID:<span class="required">*</span></label>
            <input type="text" name="employee_id" id="employee_id">
        </div>

        <div class="form-group small">
            <label for="photos">Picture 2x2:</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
        </div>

        <div class="form-group small">
        <label>Employee Type:<span class="required">*</span></label>
        <select name="employee_status" id="employee_status">
            <option value=""></option>
            <option value="Full Time">Full Time</option>
            <option value="Part Time">Part Time</option>
        </select>
        </div>

        <div class="form-group small">
        <label>Date Hired:<span class="required">*</span></label>
        <input type="date" id="" name="date_hired">
        </div>

            <div class="form-group small">
                <label>SSS ID:<span class="required">*</span></label>
                <input type="text" id="" name="sss_id">
            </div>

            <div class="form-group small">
        <label>Tin ID:<span class="required">*</span></label>
        <input type="text" id="" name="tin_id">
        </div>

        <div class="form-group small">
        <label>PAGIBIG ID:<span class="required">*</span></label>
        <input type="text" id="" name="pagibig">
        </div>

        <div class="form-group small">
        <label>PhilHealth ID<span class="required">*</span></label>
        <input type="text" id="" name="phil_id">
        </div>

    
        </div>

        
        <div class="form-group-below">
        <h2>Work Experience</h2>
        <div class="column">

                            <div class="form-group small">
                                <label for="previous-job-title">Previous Job Title:</label>
                                <input type="text" id="prev_job" name="prev_job">
                            </div>
                            <div class="form-group">
                                <label for="company-name">Company Name:</label>
                                <input type="text" id="company_name" name="company_name">
                            </div>
                            <div class="form-group ">
                                <label for="responsibilities">Responsibilities and Achievements:</label>
                                <input type="text" id="responsi" name="responsi">
                            </div>
                            <div class="form-group small">
                                <label for="employment-date">Date of Employment:</label>
                                <input type="date" id="date_employment" name="date_employment">
                            </div>
                            <div class="form-group small">
                                <label for="references">References (optional):</label>
                                <input type="text" id="refer" name="refer">
                            </div>
</div>
                        <div class="form-group-below">
                        <h2>Credentials</h2>
                        <div class="column">
                            <div class="form-group small">
                                        <label for="resume">Resume/CV:<span class="required">*</span></label>
                                        <input type="file" id="resume" name="resume">
                                    </div>
                                    <div class="form-group small">
                                        <label for="work-samples">Work Samples/Portfolio (optional):</label>
                                        <input type="file" id="work-samples" name="work_samples">
                                    </div>
                                    <div class="form-group small">
                                        <label for="certificates">Certificates (optional):</label>
                                        <input type="file" id="certificates" name="certificates">
                                    </div>
                                    <div class="form-group">
                                    <label for="questions-comments">Questions/Comments:</label>
                                    <input type="text" id="questions" name="questions">
                                </div>
        <br>
        </div>
        </div>
        </div>
        </div>
        <button type="button" class="thebutton2" onclick="prevSection('section3', 'section2')">Back</button>  
         
    </form>
    <input type="submit" class="thebutton" value="Submit" name="submit">
</div>
</div>
<script src= js/main.js></script>

</body>
</html>