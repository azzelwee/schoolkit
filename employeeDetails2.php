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
    <title>View Employee Details</title>
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
            
            <form action="delete.php" method="post">
                        <div class="button-container-delete-edit">
                            <?php if ($_SESSION['Access'] == "administrator") { ?>
                            <a href="editEmployee2.php?ID=<?php echo $row['ID'];?>#profile">Update</a>
                            <button type="submit" name="delete" class="button-danger-delete-edit">Delete</button>
                            <?php } ?>
                        </div>
                        <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
                    </form>
            <h2 class="employee-name"><?php echo $row['last_name'] . ',</br> ' . $row['first_name'] . ' ' . $row['middle_name']; ?></h2>
            
        </div>
        <div class="vertical-line"></div>
        <div class="profile-rightz">
            <div class="nav">
                <a href="#profile">Profile</a>
                <a href="#education">Education Attainment</a>
                <a href="#work">Work Experience</a>
                <a href="#employee-information">Employee Information</a>
                <a href="#credentials">Credentials</a>
                
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
                            <option value="<?php echo $row['gender']; ?>"><?php echo $row['gender']; ?></option>
                        </select>
                    </div>


                    <div class="form-group small">
                        <label for="employee-civil-status">Civil Status:</label>
                        <select id="employee-civil-status" name="civil_status" disabled>
                            <option value="<?php echo $row['civil_status'];?>"><?php echo $row['civil_status'];?></option>
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
                            <input type="text" id="" name="email" value="<?php echo $row['email'];?>" class="custom-disabled" disabled>
                        </div>
                        
                        <div class="form-group small">
                            <label for="employee-citizenship">Mobile Number:</label>
                            <input type="text" id="" name="mobile_number" value="<?php echo $row['mobile_number'];?>" class="custom-disabled" disabled>
                        </div>

                        <div class="form-group small">
                            <label for="employee-citizenship">Telephone Number:</label>
                            <input type="text" id="" name="telephone_number" value="<?php echo $row['telephone_number'];?>" class="custom-disabled" disabled>
                        </div>
                        <div class="form-group ">
                            <label for="employee-citizenship">Address:</label>
                            <input type="text" id="" name="address" value="<?php echo $row['address'];?>" class="custom-disabled" disabled>
                        </div>

                        <div class="form-group small">
                            <label for="employee-citizenship">City:</label>
                            <input type="text" id="" name="city" value="<?php echo $row['city'];?>" class="custom-disabled" disabled>
                        </div>
                        <div class="form-group small">
                            <label for="employee-citizenship">State/Province:</label>
                            <input type="text" id="" name="state_province" value="<?php echo $row['state_province'];?>" class="custom-disabled" disabled>
                        </div>
                        <div class="form-group small">
                            <label for="employee-citizenship">Postal Code:</label>
                            <input type="text" id="" name="postal_code" value="<?php echo $row['postal_code'];?>" class="custom-disabled" disabled>
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
            </div>

                </section>
                <section id="education">
                <div class="add-employee-form">
                    <h2>Education Attainment</h2>
                    <div class="column">

                    <div class="form-group">
                        <label for="employee-civil-status">Highest Education Attainment:</label>
                        <select id="educ_attain" name="educ_attain" class="custom-disabled" disabled>
                            <option value="educ_attain"><?php echo $row['educ_attain']; ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="employee-citizenship">School Name:</label>
                        <input type="text" id="school_name" name="school_name" value="<?php echo $row['school_name'];?>" class="custom-disabled" disabled>
                    </div>
                    <div class="form-group small">
                        <label for="employee-citizenship">Course/Program:</label>
                        <input type="text" id="course" name="course" value="<?php echo $row['course'];?>" class="custom-disabled" disabled>
                    </div>

                    <div class="form-group small">
                        <label for="employee-birthdate">Year Graduated:</label>
                        <input type="date" id="year_grad" name="year_grad" value="<?php echo $row['year_grad'];?>" class="custom-disabled" disabled>
                    </div>

                    <div class="form-group small">
                        <label for="employee-birthdate">Honors/Awards Received:</label>
                        <input type="text" id="honors" name="honors" value="<?php echo $row['honors'];?>" class="custom-disabled" disabled>
                    </div>

                    <div class="form-group-below">
                        <h2>Training</h2>

                    <div class="column">
                        <div class="form-group small">
                            <label for="employee-citizenship">Training Program:</label>
                            <input type="text" id="training_prog" name="training_prog" value="<?php echo $row['training_prog'];?>" class="custom-disabled" disabled>
                        </div>
                        
                        <div class="form-group small">
                            <label for="employee-citizenship">Institution/Organization:</label>
                            <input type="text" id="institution" name="institution" value="<?php echo $row['institution'];?>" class="custom-disabled" disabled>
                        </div>

                        <div class="form-group">
                            <label for="employee-citizenship">Location:</label>
                            <input type="text" id="loc" name="loc" value="<?php echo $row['loc'];?>" class="custom-disabled" disabled>
                        </div>
                        <div class="form-group small">
                            <label for="employee-citizenship">Date Started:</label>
                            <input type="date" id="data_start" name="data_start" value="<?php echo $row['date_start'];?>" class="custom-disabled" disabled>
                        </div>

                        <div class="form-group small">
                            <label for="employee-citizenship">Date Completed:</label>
                            <input type="date" id="data_complete" name="data_complete" value="<?php echo $row['date_complete'];?>" class="custom-disabled" disabled>
                        </div>

                        <div class="form-group small">
                            <label for="employee-civil-status">Certificate Received:</label>
                            <select id="cert" name="cert" class="custom-disabled" disabled>
                            <option value="<?php echo $row['cert']; ?>"><?php echo $row['cert']; ?></option>
                            </select>
                        </div>

                        <div class="form-group small">
                            <label for="employee-citizenship">Skills Acquired:</label>
                            <input type="text" id="wide" name="skills_aquired" value="<?php echo $row['skills_aquired'];?>" class="custom-disabled" disabled>
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
                                <input type="text" id="prev_job" name="prev_job" value="<?php echo $row['prev_job'];?>" class="custom-disabled" disabled>
                            </div>
                            <div class="form-group">
                                <label for="company-name">Company Name:</label>
                                <input type="text" id="company_name" name="company_name" value="<?php echo $row['company_name'];?>" class="custom-disabled" disabled>
                            </div>
                            <div class="form-group ">
                                <label for="responsibilities">Responsibilities and Achievements:</label>
                                <input type="text" id="responsi" name="responsi" value="<?php echo $row['responsi'];?>" class="custom-disabled" disabled>
                            </div>
                            <div class="form-group small">
                                <label for="employment-date">Date of Employment:</label>
                                <input type="date" id="date_employment" name="date_employment" value="<?php echo $row['date_employment'];?>" class="custom-disabled" disabled>
                            </div>
                            <div class="form-group small">
                                <label for="references">References (optional):</label>
                                <input type="text" id="refer" name="refer" value="<?php echo $row['refer'];?>" class="custom-disabled" disabled>
                            </div>
                            </div>
                </section>

                <section id="employee-information">
                <div class="add-employee-form">
                    <h2>Employee Information</h2>
                        <div class="column">
      

            <div class="form-group ">
                <label>Employee Type</label>
                <select name="employee_status" id="employee_status" class="custom-disabled" disabled>
                    <option value="employee_status"><?php echo $row['employee_status']; ?></option>
                </select>
            </div>

            <div class="form-group ">
                <label>Date Hired</label>
                <input type="date" name="date_hired" value="<?php echo $row['date_hired'];?>" class="custom-disabled" disabled>
            </div>

            <div class="form-group small">
                <label>SSS ID</label>
                <input type="text" name="sss_id" value="<?php echo $row['sss_id'];?>" class="custom-disabled" disabled>
            </div>

            <div class="form-group small">
                <label>Tin ID</label>
                <input type="text" name="tin_id" value="<?php echo $row['tin_id'];?>" class="custom-disabled" disabled>
            </div>

            <div class="form-group small">
                <label>PAGIBIG ID</label>
                <input type="text" name="pagibig" value="<?php echo $row['pagibig'];?>" class="custom-disabled" disabled>
            </div>

            <div class="form-group small">
                <label>PhilHealth ID</label>
                <input type="text" name="phil_id" value="<?php echo $row['phil_id'];?>" class="custom-disabled" disabled>
            </div>


        </div>
     </section>

                <section id="credentials">
                <div class="add-employee-form">
                    <h2>Credentials</h2>
                    <div class="column">
                                <div class="form-group small">
                                    <label for="resume">Resume/CV:</label>
                                    <a href="path/to/your/resume.pdf" download id="resume" name="resume">Download Resume/CV</a>
                                </div>
                                <div class="form-group small">
                                    <label for="work-samples">Work Samples/Portfolio:</label>
                                    <a href="path/to/your/work-samples.zip" download id="work-samples" name="work-samples">Download Work Samples/Portfolio</a>
                                </div>
                                <div class="form-group small">
                                    <label for="certificates">Certificates:</label>
                                    <a href="path/to/your/certificates.zip" download id="certificates" name="certificates">Download Certificates</a>
                                </div>
                            </br>
                            </br>
                                <div class="form-group small">
                                    <label for="questions-comments">Questions/Comments:</label>
                                    <input type="text" id="wide" name="questions" value="<?php echo $row['questions'];?>" class="custom-disabled" disabled>
                                </div>
                            </div>
                            </div>
                </section>
            </div>
        </div>
    </div>
    </div>
</div>
<script src="js/main.js"></script>

</body>
</html>
