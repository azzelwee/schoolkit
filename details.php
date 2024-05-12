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


    <div class="right-container">
        <div class="right-container-details">
        <h2>Profile Overview</h2></br>
        
                <form action="delete.php" method="post">
                    <div class="button-container">
                        
                        <?php if($_SESSION['Access'] == "administrator"){?>
                        <a href="edit.php?ID=<?php echo $row['ID'];?>">Edit</a>
                        <button type="submit" name="delete" class="button-danger">Delete</button>
                        <?php } ?>

                    </div>
                    <input type="hidden" name="ID" value="<?php echo $row['ID'];?>">
                </form>

        <div class="employee-picture-frame">
            <div class="employee-picture">
                <?php
                    // Assuming $row is the result of your database query
                    $imagePath = $row['file_path']; // Assuming 'file_path' is the column name where you stored the file path

                    // Check if it's an image file
                    $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
                    $fileExtension = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
                    $isImage = in_array($fileExtension, $allowedFormats);

                    if ($isImage) {
                        echo '<img src="' . $imagePath . '" alt="Uploaded Image" style="width: 200px; height: 200px;">';
                    } else {
                        echo '<div style="color: white; text-align: center;">There is no uploaded image.</div>';

                    }
                ?>
            </div>
        </div>
    <div class="information-employee">
        <div class="employee-name">
        <?php
            echo $row['last_name'] . ',' . $row['first_name'] . ' ' . $row['middle_name'];
        ?>
        </div>
        
        <?php
            echo '<p>Status: ' . $row['employee_status'] . '</p>';
        ?>
        
    </div>

    </div>
    </div>
</body>
</html>