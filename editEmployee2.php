<?php

if(!isset($_SESSION)){
    session_start();
}

$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");

include_once("connections/connection.php");
$con = connection();

$id = $_GET['ID'];

$sql = "SELECT * FROM employee_list2 WHERE id = '$id'" ;
$employee = $con->query($sql) or die ($con->error);
$row = $employee->fetch_assoc();


if(isset($_POST['submit'])) {
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
                $sql = "UPDATE `employee_list2` SET
                `first_name` = '$fname',
                `middle_name` = '$mname',
                `last_name` = '$lname',
                `employee_status` = '$estatus',
                `age` = '$age',
                `gender` = '$gender',
                `civil_status` = '$civilstatus',
                `citizenship` = '$citizen',
                `religion` = '$religion',
                `birthdate` = '$birthdate',
                `place_of_birth` = '$placebirth',
                `height` = '$height',
                `weight` = '$weight',
                `email` = '$email',
                `mobile_number` = '$mobile',
                `telephone_number` = '$telephone',
                `address` = '$address',
                `city` = '$city',
                `state_province` = '$state',
                `postal_code` = '$postal',
                `file_path` = '$target_file'
                WHERE `ID` = $id";
                
                $con->query($sql) or die ($con->error);

                if($con){
                    $_SESSION['status-edit'] = "Data Edited Successfully";
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
        $sql = "UPDATE `employee_list2` SET
        `first_name` = '$fname',
        `middle_name` = '$mname',
        `last_name` = '$lname',
        `employee_status` = '$estatus',
        `age` = '$age',
        `gender` = '$gender',
        `civil_status` = '$civilstatus',
        `citizenship` = '$citizen',
        `religion` = '$religion',
        `birthdate` = '$birthdate',
        `place_of_birth` = '$placebirth',
        `height` = '$height',
        `weight` = '$weight',
        `email` = '$email',
        `mobile_number` = '$mobile',
        `telephone_number` = '$telephone',
        `address` = '$address',
        `city` = '$city',
        `state_province` = '$state',
        `postal_code` = '$postal'
        WHERE `ID` = $id";
        
        $con->query($sql) or die ($con->error);

        if($con){
        $_SESSION['status-edit'] = "Data Edited Successfully";
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
    <title>Edit</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="right-container-add">
    <div class="box-container">
        <div class="employee-profile">
            <div class="profile-left">
                <div class="employees-picture">
                    </br>
                    <h3>Updating Information</h3>
                    <?php
                        $imagePath = $row['file_path'];
                        $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
                        $fileExtension = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
                        $isImage = in_array($fileExtension, $allowedFormats);
                        if ($isImage) {
                            echo '<img src="' . $imagePath . '" alt="Uploaded Image" style="width: 200px; height: 200px;">';
                        } else {
                            echo '<div style="
                            color: black; 
                            text-align: center; 
                            margin-top: 20px;
                            margin-bottom: 20px;
                            border-radius: 8px;
                            object-fit: cover;
                            border: 1px solid #c8c8c8;
                            width: 200px; 
                            height: 200px;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            ">There is no uploaded image.</div>';
                        }
                    ?>
                </div>
                <h2 class="employee-name"><?php echo $row['last_name'] . ',</br> ' . $row['first_name'] . ' ' . $row['middle_name']; ?></h2>
            </div>
            <div class="vertical-line"></div>
            <div class="profile-rightz">
                <div class="nav">
                    <a href="#profile" class="disabled">Profile </a>
                    <a href="#education"  class="disabled">Education Attainment</a>
                    <a href="#work"  class="disabled">Work Experience</a>
                    <a href="#employee-information"  class="disabled">Employee Information</a>
                    <a href="#credentials"  class="disabled">Credentials</a>
                </div>
                <form action="" method="post" enctype="multipart/form-data" class="add-employee-form">
                    <div class="contente">
                        <section id="profile">
                            <div class="add-employee-form">
                                <h2>Basic Information</h2>
                                <div class="column">
                                    <div class="form-group ">
                                        <label for="employee-first-name">First Name:</label>
                                        <input type="text" id="employee-first-name" name="first_name" value="<?php echo $row['first_name'];?>">
                                    </div>
                                    <div class="form-group small">
                                        <label for="employee-middle-name">Middle Name:</label>
                                        <input type="text" id="employee-middle-name" name="middle_name" value="<?php echo $row['middle_name'];?>">
                                    </div>
                                    <div class="form-group small">
                                        <label for="employee-last-name">Last Name:</label>
                                        <input type="text" id="employee-last-name" name="last_name" value="<?php echo $row['last_name'];?>">
                                    </div>
                                    <div class="form-group small ">
                                        <label for="employee-age">Age:</label>
                                        <input type="number" id="employee-age" name="age" value="<?php echo $row['age'];?>">
                                    </div>
                                    <div class="form-group small">
                                        <label for="employee-gender">Gender:</label>
                                        <select id="employee-gender" name="gender">
                                            <option value="gender"><?php echo $row['gender']; ?></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group small">
                                        <label for="employee-civil-status">Civil Status:</label>
                                        <select id="employee-civil-status" name="civil_status">
                                            <option value=""><?php echo $row['civil_status'];?></option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Divorced">Separated</option>
                                            <option value="Widowed">Widowed</option>
                                        </select>
                                    </div>
                                    <div class="form-group small">
                                        <label for="employee-citizenship">Citizenship:</label>
                                        <input type="text" id="employee-citizenship" name="citizenship" value="<?php echo $row['citizenship'];?>">
                                    </div>
                                    <div class="form-group small">
                                        <label for="employee-religion">Religion:</label>
                                        <input type="text" id="employee-religion" name="religion" value="<?php echo $row['religion'];?>">
                                    </div>
                                    <div class="form-group small">
                                        <label for="employee-birthdate">Birthdate:</label>
                                        <input type="date" id="employee-birthdate" name="birthdate" value="<?php echo $row['birthdate'];?>">
                                    </div>
                                    <div class="form-group ">
                                        <label for="employee-birthplace">Place of Birth:</label>
                                        <input type="text" id="employee-birthplace" name="place_of_birth" value="<?php echo $row['place_of_birth'];?>">
                                    </div>
                                    <div class="form-group small">
                                        <label for="employee-height">Height (cm):</label>
                                        <input type="number" id="employee-height" name="height" value="<?php echo $row['height'];?>">
                                    </div>
                                    <div class="form-group small">
                                        <label for="employee-weight">Weight (lbs.):</label>
                                        <input type="number" id="employee-weight" name="weight" value="<?php echo $row['weight'];?>">
                                    </div>
                                    <div class="form-group-below">
                                        <div class="add-employee-form">
                                            <h2>Contact Information</h2>
                                            <div class="column">
                                            <div class="form-group small">
                            <label for="employee-citizenship">Email:</label>
                            <input type="text" id="" name="email" value="<?php echo $row['email'];?>">
                        </div>
                                    
                                    <div class="form-group small">
                                        <label for="employee-citizenship">Mobile Number:</label>
                                        <input type="text" id="" name="mobile_number" value="<?php echo $row['mobile_number'];?>">
                                    </div>

                                    <div class="form-group small">
                                        <label for="employee-citizenship">Telephone Number:</label>
                                        <input type="text" id="" name="telephone_number" value="<?php echo $row['telephone_number'];?>">
                                    </div>
                                    <div class="form-group ">
                                        <label for="employee-citizenship">Address:</label>
                                        <input type="text" id="" name="address" value="<?php echo $row['address'];?>">
                                    </div>

                                    <div class="form-group small">
                                        <label for="employee-citizenship">City:</label>
                                        <input type="text" id="" name="city" value="<?php echo $row['city'];?>">
                                    </div>
                                    <div class="form-group small">
                                        <label for="employee-citizenship">State/Province:</label>
                                        <input type="text" id="" name="state_province" value="<?php echo $row['state_province'];?>">
                                    </div>
                                    <div class="form-group small">
                                        <label for="employee-citizenship">Postal Code:</label>
                                        <input type="text" id="" name="postal_code" value="<?php echo $row['postal_code'];?>">
                                    </div>
                                                <div class="form-group small">
                                                     &nbsp;
                                                </div>
                                                <div class="form-group small">
                                                     &nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="thebutton" onclick="showNextSection('education')">Next</button>
                        </section>
                        <section id="education" style="display: none;">
                            <div class="add-employee-form">
                                <h2>Education Attainment</h2>
                                <div class="column">
                                    <div class="form-group small">
                                        <label for="employee-education">Highest Education Attainment:</label>
                                        <select id="employee-education" name="highest_education">
                                            <option value="">Select</option>
                                            <option value="elementary">Elementary</option>
                                            <option value="high_school">High School</option>
                                            <option value="vocational">Vocational/Technical</option>
                                            <option value="college">College/Bachelor's Degree</option>
                                            <option value="doctorate">Doctorate Degree</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="school-name">School Name:</label>
                                        <input type="text" id="school-name" name="school_name">
                                    </div>
                                    <div class="form-group small">
                                        <label for="course-program">Course/Program:</label>
                                        <input type="text" id="course-program" name="course_program">
                                    </div>
                                    <div class="form-group small">
                                        <label for="year-graduated">Year Graduated:</label>
                                        <input type="date" id="year-graduated" name="year_graduated">
                                    </div>
                                    <div class="form-group small">
                                        <label for="honors-awards">Honors/Awards Received (if applicable):</label>
                                        <input type="text" id="honors-awards" name="honors_awards">
                                    </div>
                                    <div class="form-group-below">
                                        <div class="add-employee-form">
                                            <h2>Training</h2>
                                            <div class="column">
                                                <div class="form-group small">
                                                    <label for="training-program">Training Program:</label>
                                                    <input type="text" id="training-program" name="training_program">
                                                </div>
                                                <div class="form-group small">
                                                    <label for="institution-organization">Institution/Organization:</label>
                                                    <input type="text" id="institution-organization" name="institution_organization">
                                                </div>
                                                <div class="form-group">
                                                    <label for="training-location">Location:</label>
                                                    <input type="text" id="training-location" name="training_location">
                                                </div>
                                                <div class="form-group small">
                                                    <label for="date-started">Date Started:</label>
                                                    <input type="date" id="date-started" name="date_started">
                                                </div>
                                                <div class="form-group small">
                                                    <label for="date-completed">Date Completed:</label>
                                                    <input type="date" id="date-completed" name="date_completed">
                                                </div>
                                                <div class="form-group small">
                                                    <label for="certificate-received">Certificate Received:</label>
                                                    <select id="certificate-received" name="certificate_received">
                                                        <option value=""></option>
                                                        <option value="yes">Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                </div>
                                                <div class="form-group small">
                                                    <label for="skills-acquired">Skills Acquired:</label>
                                                    <input type="text" id="skills-acquired" name="skills_acquired">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="thebutton3" onclick="showPreviousSection('profile')">Back</button>
                            <button type="button" class="thebutton" onclick="showNextSection('work')">Next</button>
                        </section>
                        <section id="work" style="display: none;">
                            <div class="add-employee-form">
                                <h2>Work Experience</h2>
                                <div class="column">
                                    <div class="form-group small">
                                        <label for="previous-job-title">Previous Job Title:</label>
                                        <input type="text" id="previous-job-title" name="previous_job_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="company-name">Company Name:</label>
                                        <input type="text" id="company-name" name="company_name">
                                    </div>
                                    <div class="form-group ">
                                        <label for="responsibilities">Responsibilities and Achievements:</label>
                                        <input type="text" id="responsibilities" name="responsibilities">
                                    </div>
                                    <div class="form-group small">
                                        <label for="employment-date">Date of Employment:</label>
                                        <input type="date" id="employment-date" name="employment_date">
                                    </div>
                                    <div class="form-group small">
                                        <label for="references">References (optional):</label>
                                        <input type="text" id="references" name="references">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="thebutton3" onclick="showPreviousSection('education')">Back</button>
                            <button type="button" class="thebutton" onclick="showNextSection('employee-information')">Next</button>
                        </section>
                        <section id="employee-information">
                <div class="add-employee-form">
                    <h2>Employee Information</h2>
                        <div class="column">
                        <div class="form-group">
                <label for="photos">Picture 2x2:</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
            </div>

            <div class="form-group small">
                <label>Employee Type</label>
                <select name="employee_status" id="employee_status">
                    <option value=""></option>
                    <option value="Full Time">Full Time</option>
                    <option value="Part Time">Part Time</option>
                </select>
            </div>

            <div class="form-group small">
                <label>Date Hired</label>
                <input type="date">
            </div>

            <div class="form-group small">
                <label>SSS ID</label>
                <input type="text">
            </div>

            <div class="form-group small">
                <label>Tin ID</label>
                <input type="text">
            </div>

            <div class="form-group small">
                <label>PAGIBIG ID</label>
                <input type="text">
            </div>

            <div class="form-group small">
                <label>PhilHealth ID</label>
                <input type="text">
            </div>


        </div>
                    <button type="button" class="thebutton3" onclick="showPreviousSection('employee-information')">Back</button>
                    <button type="button" class="thebutton" onclick="showNextSection('credentials')">Next</button>
     </section>
                        <section id="credentials" style="display: none;">
                            <div class="add-employee-form">
                                <h2>Credentials</h2>
                                <div class="column">
                                    <div class="form-group small">
                                        <label for="resume">Resume/CV:</label>
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
                                        <input type="text" id="questions-comments" name="questions_comments">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="thebutton3" onclick="showPreviousSection('work')">Back</button>
                            <input type="submit" class="thebutton" value="Submit" name="submit">
                        </section>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/main.js"></script>

</body>
</html>
