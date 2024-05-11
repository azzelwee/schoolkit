<?php

if(!isset($_SESSION)){
    session_start();
}


$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");

include_once("connections/connection.php");
$con = connection();

$start = 0;
$rows_per_page = 10;

$employee = $con->query("SELECT * FROM employee_list");
$nr_of_rows = $employee->num_rows;

$pages = ceil($nr_of_rows / $rows_per_page);

if(isset($_GET['page-nr'])){
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
}

$sql = "SELECT * FROM employee_list ORDER BY id DESC LIMIT $start, $rows_per_page";
$employee = $con->query($sql) or die ($con->error);
$row = $employee->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
    <?php
        if(isset($_GET['page-nr'])){
            $id = $_GET['page-nr'];
        }else {
            $id = 1;
        }

    ?>
<body id="<?php echo $id ?>">

<div class="header">
        <div class="side-nav">
            <a href="#"class="logo">
                <img src="img/nbswhite.png" class="logo-img">
            </a>
            <ul class="nav-links">
                <li><a href="dashboard.php"><img src="img/dashboard.png" class="imgs"><p>Dashboard</p></a></li>
                <li><a href="maintenance.php"><img src="img/structures.png"><p>Maintenance</p></a></li>
               
                <!-- <?php if ($is_admin): ?>
                <li><a href="employee.php"><img src="img/groups.png"><p>Employee</p></a></li>
                <?php endif; ?> -->
                
                <li><a href="reports.php"><img src="img/settings.png"><p>Reports</p></a></li>
                <?php if(isset($_SESSION['UserLogin'])){?>
                    <li><a href="logout.php"><img src="img/out.png"><p>Logout</p></a></li>
                    <?php } else {?>

                    <li><a href="login.php"><img src="img/out.png"><p>Login</p></a></li>
                <?php } ?>

                <div class="active">
                </div>
            </ul>

    </div>

    <div class="right-container-add">
        <!-- <form action="result.php" method="get">
            <div class="search">
                <img src="img/search.png" class="search-icon">
                <input class="search-input" name="search" placeholder="Search">
            </div>
        </form> -->


        <div class="add-form">
        <form action="" method="post">
                <div class="add-navigation">
                    <p>Basic Information</p>
                    <p>•</p>
                    <p>Education Background</p>
                    <p>•</p>
                    <p>Employee Information</p>
                    
                </div>
        <div id="section1">
            <div class="lineup1">
                <div class="column">
                    </br>
                    <h2>Basic Information</h2>
                    </br>

                    <label>First Name</label>
                    <input type="text" required placeholder="Enter First Name">
                    </br>
                    <label>Middle Name</label>
                    <input type="text" required placeholder="Enter Middle Name">
                    </br>
                    <label>Last Name</label>
                    <input type="text" required placeholder="Enter Last Name">
                    </br>
                    <label>Age</label>
                    <input type="text" id="smaller" required>
                
                    <label>Gender</label>
                    <select required id="small">
                        <option value=""></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>

                    
                    <label>Height(cm)</label>
                    <input type="text" id="small">
                    
                    <label>Weight(lbs.)</label>
                    <input type="text" id="small">
                    
                    <label>Birthdate</label>
                    <input type="text"  required placeholder="MM-DD-YY">
                    </br>
                    <label>Place of Birth</label>
                    <input type="text" required placeholder="Enter Place of Birth">
                    </br>
                    <label>Religion</label>
                    <input type="text" required placeholder="Enter Religion">
                    </br>
                    <label>Civil Status</label>
                    <select required>
                        <option value=""></option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Separated">Separated</option>
                    </select>
                    </br>
                    <label>Citizenship</label>
                    <input type="text" required placeholder="Enter Citizenship">

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
                    <input type="text" style="width: 560px" required placeholder="Enter Mobile Number">
                    </br>
                    <label>Telephone Number</label>
                    <input type="text" style="width: 530px" required placeholder="Enter Telephone Number">
                    </br>
                        <label>Email</label>
                        <input type="text" style="width: 637px" required placeholder="Enter Email">
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
                <!-- <label>Level</label>
                    <select required>
                        <option value=""></option>
                        <option value="">Elementary</option>
                        <option value="">High School</option>
                        <option value="">College</option>
                    </select> -->

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
            <input type="file" id="photos" multiple style="width: 763px">
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
            <select>
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
            <input type="submit" class="thebutton"></button>
            
    </form>
</div>
<script src= js/main.js></script>

</body>
</html>