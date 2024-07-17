<?php
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['applicant_id'])) {
    $applicant_id = (int)$_POST['applicant_id'];

    // Fetch applicant details
    $sql = "SELECT * FROM applicant_list2 WHERE ID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $applicant_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $applicant = $result->fetch_assoc();
    } else {
        echo "Applicant not found.";
        exit;
    }
}

if (isset($_POST['schedule'])) {
    $interview_date = $_POST['interview_date'];
    $interview_time = $_POST['interview_time'];

    // Update the interview schedule in the applicant_list2 table
    $sql = "UPDATE applicant_list2 SET interview_date = ?, interview_time = ? WHERE ID = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssi", $interview_date, $interview_time, $applicant_id);

    if ($stmt->execute()) {
        $_SESSION['status-add'] = "Interview scheduled successfully.";
    } else {
        $_SESSION['status-delete'] = "Error scheduling interview: " . $stmt->error;
    }

    $stmt->close(); // Close the statement

    // Redirect to employeeOnboarding2.php after processing
    header("Location: employeeOnboarding2.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Interview</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'header.php'; ?>

<div class="right-container">
    <div class="box-container">
        <h2>Set a Schedule for Interview</h2>
        <div class="gauge-line"></div>
        <p>You are scheduling an interview for applicant: <?php echo htmlspecialchars($applicant['first_name'] . ' ' . $applicant['last_name']); ?></p>
        <form method="post" action="scheduleInterview.php">
            <input type="hidden" name="applicant_id" value="<?php echo $applicant['ID']; ?>">
            </br>

            <?php if (isset($message)): ?>
                <p><?php echo $message; ?></p>
            <?php endif; ?>

            <div class="add-employee-form">
                <div class="column">
                    <div class="form-group">
                        <label for="interview_date">Interview Date:</label>
                        <input type="date" id="semi-wide" name="interview_date" placeholder="asd" required><br>
                    </div>
                </div>
                </br>
                <div class="column">
                    <div class="form-group ">
                        <label for="interview_time">Interview Time:</label>
                        <input type="time" id="semi-wide"name="interview_time" required><br>
                    </div>
                </div>
                </div>
            </br>    
            <button type="submit" name="schedule" class="thebutton">Submit</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
