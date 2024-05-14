<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");

$con = connection();
$id = $_GET['ID'];

$sql = "SELECT * FROM employee_list WHERE id = '$id'" ;
$employee = $con->query($sql) or die ($con->error);
$row = $employee->fetch_assoc();

if(isset($_POST['submit'])){

    $fname = $_POST['fullname'];
    $email = $_POST['email'];
    $dprtment = $_POST['departments'];

    $sql = "UPDATE employee_list SET full_name = '$fname', contact_information = '$email', department = '$dprtment' WHERE id = '$id'";

    $con->query($sql) or die ($con->error);
    echo header("Location: employee.php");

    if($con){
        $_SESSION['status-edit'] = "Data Edited Successfully";
        header('Location: listEmployee.php');
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
                    <input type="text" id="smaller" >
                
                    <label>Gender</label>
                    <select  id="small">
                        <option value=""></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>

                    
                    <label>Height(cm)</label>
                    <input type="text" id="small">
                    
                    <label>Weight(lbs.)</label>
                    <input type="text" id="small">
                    
                    <label>Birthdate</label>
                    <input type="text"   placeholder="MM-DD-YY">
                    </br>
                    <label>Place of Birth</label>
                    <input type="text"  placeholder="Enter Place of Birth">
                    </br>
                    <label>Religion</label>
                    <input type="text"  placeholder="Enter Religion">
                    </br>
                    <label>Civil Status</label>
                    <select >
                        <option value=""></option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Separated">Separated</option>
                    </select>
                    </br>
                    <label>Citizenship</label>
                    <input type="text"  placeholder="Enter Citizenship">

                </div>

                <div class="column">
                </br>
                    <h2>Contact Information</h2>
                    </br>
                    <label>No./St./Subd.</label>
                    <input type="text" id="small">
                    
                    <label>City</label>
                    <input type="text" id="small">
                    
                    <label>Address</label>
                    <input type="text" id="semi-small">
                    </br>
                    <label>Zip Code</label>
                    <input type="text" id="small">
                    
                    <label>Country</label>
                    <input type="text" id="semi-small" style="width: 417px;">
                    </br>
                    <label>Mobile Number</label>
                    <input type="text" style="width: 560px"  placeholder="Enter Mobile Number">
                    </br>
                    <label>Telephone Number</label>
                    <input type="text" style="width: 530px"  placeholder="Enter Telephone Number">
                    </br>
                        <label>Email</label>
                        <input type="text" style="width: 637px"  placeholder="Enter Email">
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
        <input type="text" id="wide">

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
        <input type="text" id="wide" style="width: 763px">
        </br>

            </div>
        </div>
            <button type="button" class="thebutton" onclick="prevSection('section2', 'section1')">Back</button>
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
        <input type="text">
        </br>
        <label>Date Separated</label>
        <input type="text">
        </br>
        <label>Reason for Leaving</label>
        <input type="text" id="wide">
        <br>
        </div>
        </div>
        <button type="button" class="thebutton" onclick="prevSection('section3', 'section2')">Back</button>   
    </form>
    <input type="submit" class="thebutton" value="Submit" name="submit">
</div>
<script src= js/main.js></script>

</body>
</html>