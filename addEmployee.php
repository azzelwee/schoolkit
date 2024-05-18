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
        <form action="" method="post" enctype="multipart/form-data">
        <div id="section1">
            <div class="lineup1">
                <div class="column">
                    </br>
                    <h2>Basic Information</h2>
                    </br>

                    <label>First Name</label>
                    <input type="text" name="first_name" id="first_name" placeholder="Enter First Name">
                    </br>
                    <label>Middle Name</label>
                    <input type="text" name="middle_name" id="middle_name" placeholder="Enter Middle Name">
                    </br>
                    <label>Last Name</label>
                    <input type="text" name="last_name" id="last_name" placeholder="Enter Last Name">
                    </br>
                    <label>Age</label>
                    <input type="text" id="smaller" style="width: 70px;">
                
                    <label>Gender</label>
                    <select  id="small" style="width: 120px;">
                        <option value=""></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>

</br>
                    <label>Height(cm)</label>
                    <input type="text" id="small" style="width: 70px;">
                    
                    <label>Weight(lbs.)</label>
                    <input type="text" id="small" style="width: 70px;">
</br>
                    <label>Birthdate</label>
                    <input type="text"   placeholder="MM-DD-YY" style="width: 130px;">
                    <label>&nbsp&nbspPlace of Birth</label>
                    <input type="text"  placeholder="Enter Place of Birth" style="width: 190px;">
                    </br>
                    <label>Religion</label>
                    <input type="text"  placeholder="Enter Religion">
                    </br>
                    <label>Civil Status</label>
                    <select style="width: 130px;">
                        <option value=""></option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Separated">Separated</option>
                    </select>
                    <label>Citizenship</label>
                    <input type="text"  placeholder="Enter Citizenship" style="width: 200px;">

                </div>

                <div class="column">
                </br>
                    <h2>Contact Information</h2>
                    </br>
                    <label>Address</label>
                    <input type="text" id="small" style="width: 417px; height: 77px;">
</br>
                    <label>Country</label>
                    <input type="text" id="semi-small" style="width: 417px;">
                    </br>
                    <label>Mobile Number</label>
                    <input type="text" style="width: 360px"  placeholder="Enter Mobile Number">
                    </br>
                    <label>Telephone Number</label>
                    <input type="text" style="width: 330px"  placeholder="Enter Telephone Number">
                    </br>
                        <label>Email</label>
                        <input type="text" style="width: 337px"  placeholder="Enter Email" >
                    </br>
                </div>
            </div>
        <button type="button" class="thebutton" onclick="nextSection('section1', 'section2')">Next</button>
        </div>
    
        <div id="section2" style="display: none;">
        <div class="lineup1">
        <div class="column">
        </br>
        <h2>Education</h2>
        </br>

        <label>Elemantary</label>
        <input type="text">
        </br>
        <label>High School</label>
        <input type="text">
        </br>
        <label>Vocational</label>
        <input type="text">
        </br>
        <label>College</label>
        <input type="text">
        </br>
        <label>Course</label>
        <input type="text">
        </br>
        <label>Achievements</label>
        <input type="text" id="wide" style="width: 507px;">

            </div>
            <div class="column">
                    <h2>Training</h2>
                    </br>
                    
        <label>Title</label>
        <input type="text">
        </br>
        <label>Training Company</label>
        <input type="text">
        </br>
        <label>Inclusive Dates</label>
        <input type="text">
        </br>
        <label>Venue</label>
        <input type="text">
        </br>
        <label>Remarks</label>
        <input type="text" id="wide" style="width: 508px">
        </br>

            </div>
        </div>
            <button type="button" class="thebutton2" onclick="prevSection('section2', 'section1')">Back</button>
            <button type="button" class="thebutton" onclick="nextSection('section2', 'section3')">Next</button>
    </div>

        <div id="section3" style="display: none;">
        <div class="lineup1">
        <div class="column">
        </br>
        <h2>Employee Information</h2>
        </br>
            <label for="photos">Picture 2x2:</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <!-- <input type="submit" value="Upload File" name="submit"> -->
        </br>
        <label>SSS ID</label>
        <input type="text" >
        </br>
        <label>Tin ID</label>
        <input type="text">
        </br>
        <label>PAGIBIG ID</label>
        <input type="text">
        </br>
        <label>PhilHealth ID</label>
        <input type="text">
        </br>
        <label>Employee Status</label>
        <select name="employee_status" id="employee_status">
            <option value="">-- status --</option>
            <option value="Pending">Pending</option>
            <option value="Hired">Hired</option>
        </select>
        </br>
        <label>Date Hired</label>
        <input type="text" placeholder="MM-DD-YY">
        </div>

        <div class="column">
        <h2>Employment History</h2>
        </br>
        <label>Company Name</label>
        <input type="text">
        </br>
        <label>Nature of Business</label>
        <input type="text">
        </br>
        <label>Company Address</label>
        <input type="text">
        </br>
        <label>Branch Department</label>
        <input type="text">
        </br>
        <label>Position</label>
        <input type="text">
        </br>
        <label>Salary Rate</label>
        <input type="text">
        </br>
        <label>Date Hired</label>
        <input type="text" style="width: 117px;"> 
        <label>&nbsp&nbsp Date Separated</label>
        <input type="text" style="width: 117px;">
        </br>
        <label>Reason for Leaving</label>
        <input type="text" id="wide" style="width: 507px; height: 50px;">
        <br>
        </div>
        </div>
        <button type="button" class="thebutton" onclick="prevSection('section3', 'section2')">Back</button>   
    </form>
    <input type="submit" class="thebutton" value="Submit" name="submit">
</div>
</div>
<script src= js/main.js></script>

</body>
</html>