<?php
ob_start(); // Start output buffering
if (!isset($_SESSION)) {
    session_start();
}

include_once("connections/connection.php");

$con = connection();
$id = $_GET['ID'];

if (isset($id)) {
    $id = intval($id); // Sanitize input

    // Fetch the resume path from the database
    $sql = "SELECT resume_path FROM applicant_list2 WHERE ID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($resumePath);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        // Check if resume path is empty
        if (empty($resumePath) || !file_exists($resumePath)) {
            $_SESSION['status-delete'] = "There is no CV/Resume Uploaded. File Not Found.";
            header('Location: employeeOnboarding.php'); // Change this to your desired redirect page
            exit;
        }

        // Set headers for download
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($resumePath) . '"');
        header('Content-Length: ' . filesize($resumePath));
        readfile($resumePath);
        exit;
    } else {
        echo "No record found for the provided ID.";
    }
    $stmt->close();
} else {
    echo "Invalid request.";
}

$con->close();
ob_end_flush(); // Flush the output buffer
?>
