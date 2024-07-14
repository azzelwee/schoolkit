<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];

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
    echo "No file specified.";
}
?>
