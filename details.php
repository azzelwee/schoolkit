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

        <div class="fullname">
           <p>Name:</p> <?php echo $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];?>
        </div>
        
    <?php
        // Assuming $row is the result of your database query
        $imagePath = $row['file_path']; // Assuming 'file_path' is the column name where you stored the file path

        // Check if it's an image file
        $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        $isImage = in_array($fileExtension, $allowedFormats);

        if ($isImage) {
            echo '<img src="' . $imagePath . '" alt="Uploaded Image" style="width: 100px; height: 100px;">'; // Adjust width and height
        } else {
            echo 'There is no uploaded image.';
        }
    ?>


    </div>
</body>
</html>