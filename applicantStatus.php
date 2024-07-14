<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();

$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="right-container">
    <div class="box-container">
            <h2>Applicant Status</h2>
            <div class="gauge-line"></div>
            
            <table id="table2">
        <thead>
        <tr>
            <th>Details</th>
            <th>Status</th>
            <th>Action</th>
            
        </tr>
    </thead>
    <tbody>

            <tr>
                <td>Date Applied:</br></br>
                    Applying Type: Teaching</br></br>
                    Section: Mandarin</br></br>
                    Applying Status: Full Time
                </td>
                <td>Pending</td>
                <td>For Revision</td>
            </tr>

    </tbody>
</table>

        </div>
    </div>

    <table>
        
    </table>

    <footer>
    &copy; 2024 NBS College. If you have any questions or concerns, please contact us.
    Email: info@nbscollege.edu.ph
    Contact Number:(02) 8376-5090, 0917-8076850, 0961-3826332
    </footer>

</body>
<script src= js/main.js></script>
</html>