<?php

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();


if (isset($_GET['ID']) && isset($_GET['action']) && $_GET['action'] === 'preview') {
    $id = $_GET['ID'];

    // Fetch the resume path from the database
    $sql = "SELECT resume_path FROM applicant_list2 WHERE ID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file = $row['resume_path'];

        // Ensure the file exists and is a valid PDF
        if (file_exists($file) && mime_content_type($file) === 'application/pdf') {
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . basename($file) . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            @readfile($file);
        } else {
            echo "Invalid file.";
        }
    } else {
        echo "No record found.";
    }
} else {
    echo "Invalid request.";
}
?>
