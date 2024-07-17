<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once('connections/connection.php');
$con = connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date']; // Get the date
    $note = $_POST['note']; // Get the note

    // Check if the note is empty
    if ($note === null || $note === '') {
        $note = ''; // Ensure it's an empty string instead of null
    }

    // Prepare the SQL statement
    $stmt = $con->prepare("INSERT INTO notes (date, note) VALUES (?, ?) ON DUPLICATE KEY UPDATE note = ?");
    $stmt->bind_param("sss", $date, $note, $note); // Bind all as strings

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
    $con->close(); // Close the connection
}
?>