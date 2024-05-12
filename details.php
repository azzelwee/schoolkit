<?php

if(!isset($_SESSION)){
    session_start();
}

$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");

include_once("connections/connection.php");
$con = connection();

$sql = "SELECT * FROM employee_list2 ORDER BY id DESC";
$employee = $con->query($sql) or die ($con->error);
$row = $employee->fetch_assoc();
        // Connect to your database (you might already have this included in your code)
        // Include your database connection file here if not already included

        // Check if the ID parameter is set in the URL
        if(isset($_GET['ID'])) {
            // Get the ID from the URL parameter
            $employee_id = $_GET['ID'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body id="<?php echo $id ?>">

<?php include 'header.php'; ?>

    <div class="right-container">
        <h2>Employee Information</h2></br>
        
    <form action="delete.php" method="post">
        <div class="button-container">
            
            <?php if($_SESSION['Access'] == "administrator"){?>
            <a href="edit.php?ID=<?php echo $row['ID'];?>">Edit</a>
            <button type="submit" name="delete" class="button-danger">Delete</button>
            <?php } ?>

        </div>
        <input type="hidden" name="ID" value="<?php echo $row['ID'];?>">
    </form>

    <?php


            // Query the database to fetch the details of the employee with this ID
            // Example query: SELECT * FROM employees WHERE ID = $employee_id
            // Execute your query and fetch the result

            // Example code assuming $result contains the fetched details
            if($row) {
                // Display the details of the employee
                echo '<h1>Employee Details</h1>';
                echo '<p>First Name: ' . $row['first_name'] . '</p>';
                echo '<p>Middle Name: ' . $row['middle_name'] . '</p>';
                echo '<p>Last Name: ' . $row['last_name'] . '</p>';
                echo '<p>Status: ' . $row['employee_status'] . '</p>';
                // Display other relevant details here
            } else {
                // Handle the case where the employee ID is not found
                echo '<p>Employee not found.</p>';
            }
        } else {
            // Handle the case where the ID parameter is not set
            echo '<p>Employee ID not provided.</p>';
        }
        ?>




    </div>
</body>
</html>