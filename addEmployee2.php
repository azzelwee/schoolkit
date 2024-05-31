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

            
            <form action="" method="post" enctype="multipart/form-data" class="add-employee-form">
            <div class="section1">
            <h2>Basic Information</h2>
                <div id="lineup1" class="form-page">
                    <div class="form-group small">
                        <label for="employee-first-name">First Name:</label>
                        <input type="text" id="employee-first-name" name="employee-first-name">
                    </div>
                    
                    <div class="form-group small">
                        <label for="employee-middle-name">Middle Name:</label>
                        <input type="text" id="employee-middle-name" name="employee-middle-name">
                    </div>

                    <div class="form-group small">
                        <label for="employee-last-name">Last Name:</label>
                        <input type="text" id="employee-last-name" name="employee-last-name">
                    </div>

                    <div class="form-group">
                        <label for="employee-email">Email:</label>
                        <input type="email" id="employee-email" name="employee-email">
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
                        <label for="employee-height">Height (cm):</label>
                        <input type="number" id="employee-height" name="employee-height">
                    </div>

                    <div class="form-group small">
                        <label for="employee-weight">Weight (lbs.):</label>
                        <input type="number" id="employee-weight" name="employee-weight">
                    </div>

                    <div class="form-group small">
                        <label for="employee-birthdate">Birthdate:</label>
                        <input type="date" id="employee-birthdate" name="employee-birthdate">
                    </div>

                    <div class="form-group small">
                        <label for="employee-birthplace">Place of Birth:</label>
                        <input type="text" id="employee-birthplace" name="employee-birthplace">
                    </div>

                    <div class="form-group small">
                        <label for="employee-religion">Religion:</label>
                        <input type="text" id="employee-religion" name="employee-religion">
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

                    <div class="form-group-below">
                        <h2>Contact Information</h2>
                    </div>

                    <div class="form-group-button">
                        <button type="submit">Add Employee</button>
                    </div>

                </div>
                <button type="button" class="thebutton" onclick="nextSection('section1', 'section2')">Next</button>
            </div>

            <div id="section2" style="display: none;">
                <h2>Second Information</h2>
                    <div class="lineup1">

                            <div class="form-group small">
                                <label for="employee-first-name">Middle Name:</label>
                                <input type="text" id="employee-first-name" name="employee-first-name">
                            </div>  

                     </div>
                    <button type="button" class="thebutton2" onclick="prevSection('section2', 'section1')">Back</button>
                    <button type="button" class="thebutton" onclick="nextSection('section2', 'section3')">Next</button>
                </div>

                <div id="section3" style="display: none;">
                <h2>Last Information</h2>
                    <div class="lineup1">
                        <div class="column">
                            
                            <div class="form-group small">
                                <label for="employee-first-name">Last Name:</label>
                                <input type="text" id="employee-first-name" name="employee-first-name">
                            </div>  

                        </div>
                        <button type="button" class="thebutton" onclick="prevSection('section3', 'section2')">Back</button>   
                </form>
                <input type="submit" class="thebutton" value="Submit" name="submit">
            </div>
<script src= js/main.js></script>
</body>
</html>