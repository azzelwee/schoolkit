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
        <div class="employee-profile">
        <div class="profile-left">
            <div class="employees-picture">
            <?php
                $imagePath = $row['file_path'];
                $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
                $fileExtension = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
                $isImage = in_array($fileExtension, $allowedFormats);
                if ($isImage) {
                echo '<img src="' . $imagePath . '" alt="Uploaded Image" style="width: 200px; height: 200px;">';
                    } else {
                echo '<div style="color: black; text-align: left; margin-bottom: 10px; margin-right: 50px;">There is no uploaded image.</div>';
                     }
                ?>
            </div>
            
            <form action="delete.php" method="post">
                        <div class="button-container-delete-edit">
                            <?php if ($_SESSION['Access'] == "administrator") { ?>
                            <a href="editEmployee.php?ID=<?php echo $row['ID']; ?>">Update</a>
                            <button type="submit" name="delete" class="button-danger-delete-edit">Delete</button>
                            <?php } ?>
                        </div>
                        <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
                    </form>
            <h2 class="employee-name"><?php echo $row['last_name'] . ',</br> ' . $row['first_name'] . ' ' . $row['middle_name']; ?></h2>
            
        </div>
        <div class="profile-rightz">
            <div class="nav">
                <a href="#profile">Profile</a>
                <a href="#education">Education Attainment</a>
                <a href="#work">Work Experience</a>
                <a href="#credentials">Credentials</a>
                <a href="#test">test</a>
            </div>
            
    <div class="contente">
        <section id="profile">
        
        <div class="add-employee-form">
            <h2>Basic Information</h2>
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

                    <div class="form-group-below">
                    <div class="add-employee-form">
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
                        </div>
                        </div>
                    </div>

                    
                </div>
            </div>

                </section>
                <section id="education">
                <div class="add-employee-form">
                    <h2>Education Attainment</h2>
                    <div class="column">
                    <div class="form-group small">
                        <label for="employee-civil-status">Highest Education Attainment:</label>
                        <select id="employee-civil-status" name="employee-civil-status">
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
                        <input type="text" id="employee-citizenship" name="employee-citizenship">
                    </div>
                    <div class="form-group small">
                        <label for="employee-citizenship">Course/Program:</label>
                        <input type="text" id="employee-citizenship" name="employee-citizenship">
                    </div>

                    <div class="form-group small">
                        <label for="employee-birthdate">Year Graduated:</label>
                        <input type="date" id="employee-birthdate" name="employee-birthdate">
                    </div>

                    <div class="form-group small">
                        <label for="employee-birthdate">Honors/Awards Received (if applicable):</label>
                        <input type="text" id="employee-birthdate" name="employee-birthdate">
                    </div>

                    <div class="form-group-below">
                    <div class="add-employee-form">
                    <h2>Training</h2>
                    <div class="column">
                    <div class="form-group small">
                        <label for="employee-citizenship">Training Program:</label>
                        <input type="text" id="employee-citizenship" name="employee-citizenship">
                    </div>
                    
                    <div class="form-group small">
                        <label for="employee-citizenship">Institution/Organization:</label>
                        <input type="text" id="employee-citizenship" name="employee-citizenship">
                    </div>

                    <div class="form-group">
                        <label for="employee-citizenship">Location:</label>
                        <input type="text" id="employee-citizenship" name="employee-citizenship">
                    </div>
                    <div class="form-group small">
                        <label for="employee-citizenship">Date Started:</label>
                        <input type="date" id="employee-citizenship" name="employee-citizenship">
                    </div>

                    <div class="form-group small">
                        <label for="employee-citizenship">Date Completed:</label>
                        <input type="date" id="employee-citizenship" name="employee-citizenship">
                    </div>

                    <div class="form-group small">
                        <label for="employee-civil-status">Certificate Received:</label>
                        <select id="employee-civil-status" name="employee-civil-status">
                            <option value=""></option>
                            <option value="single">Yes</option>
                            <option value="married">No</option>
                        </select>
                    </div>

                    <div class="form-group small">
                        <label for="employee-citizenship">Skills Acquired:</label>
                        <input type="text" id="wide" name="employee-citizenship" >
                    </div>
                    </div>
                    </div>
                    </div>


                </section>
                <section id="work">
                <div class="add-employee-form">
            <h2>Work Experience</h2>
            <div class="column">
                            <div class="form-group small">
                                <label for="previous-job-title">Previous Job Title:</label>
                                <input type="text" id="previous-job-title" name="previous-job-title">
                            </div>
                            <div class="form-group">
                                <label for="company-name">Company Name:</label>
                                <input type="text" id="company-name" name="company-name">
                            </div>
                            <div class="form-group ">
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
                </section>
                <section id="credentials">
                <div class="add-employee-form">
                    <h2>Credentials</h2>
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
                </section>

                <section id="test">
                ddd
                </section>
            </div>
        </div>
    </div>
    </div>
</div>
<script src="js/main.js"></script>

</body>
</html>
