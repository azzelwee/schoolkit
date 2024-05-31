<?php

if(!isset($_SESSION)){
    session_start();
}

$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");

include_once("connections/connection.php");
$con = connection();

if(isset($_POST['submit'])) {
    $fname = $_POST['first_name'];
    $mname = $_POST['middle_name'];
    $lname = $_POST['last_name'];
    $estatus = $_POST['employee_status'];

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
                $sql = "INSERT INTO `employee_list2`(`first_name`, `middle_name`, `last_name`, `employee_status`, `file_path`) 
                VALUES ('$fname','$mname','$lname', '$estatus', '$target_file')";
                
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
        $sql = "INSERT INTO `employee_list2`(`first_name`, `middle_name`, `last_name`, `employee_status`) 
        VALUES ('$fname','$mname','$lname', '$estatus')";
        
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
        <h2>Basic Information</h2>
            <div class="form-page">
                <div class="column">
                    <div class="form-group ">
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



                    <div class="form-group small ">
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

                    <div class="form-group ">
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
        <button type="button" class="thebutton" onclick="nextSection('section1', 'section2')">Next</button>
        </div>
    
        <div id="section2" style="display: none;">
        <h2>Education</h2>
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
                        <h2>Training (if applicable)</h2>

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
            <button type="button" class="thebutton2" onclick="prevSection('section2', 'section1')">Back</button>
            <button type="button" class="thebutton" onclick="nextSection('section2', 'section3')">Next</button>
    </div>

        <div id="section3" style="display: none;">
        
        <h2>Employee Information</h2>
        <div class="lineup1">
            <div class="column">


            <div class="form-group small">
                <label for="photos">Picture 2x2:</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
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

        <div class="form-group small">
        <label>Employee Status</label>
        <select name="employee_status" id="employee_status">
            <option value="">-- status --</option>
            <option value="Pending">Pending</option>
            <option value="Hired">Hired</option>
        </select>
        </div>

        <div class="form-group small">
        <label>Date Hired</label>
        <input type="date">
        </div>
        </div>

        
        <div class="form-group-below">
        <h2>Employment History</h2>
        <div class="column">

        <div class="form-group small">
        <label>Company Name</label>
        <input type="text">
        </div>

        <div class="form-group small">
        <label>Nature of Business</label>
        <input type="text">
        </div>

        <div class="form-group small">
        <label>Company Address</label>
        <input type="text">
        </div>

        <div class="form-group small">
        <label>Branch Department</label>
        <input type="text">
        </div>

        <div class="form-group small">
        <label>Position</label>
        <input type="text">
        </div>

        <div class="form-group small">
        <label>Salary Rate</label>
        <input type="text">
        </div>

        <div class="form-group small">
        <label>Date Hired</label>
        <input type="text"> 
        </div>

        <div class="form-group small">
        <label>Date Separated</label>
        <input type="text">
        </div>

        <div class="form-group small">
        <label>Reason for Leaving</label>
        <input type="text" id="wide">
        </div>
        <br>
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