<?php

if(!isset($_SESSION)){
    session_start();
}

$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");

include_once("connections/connection.php");
$con = connection();
$rows_per_page = 4;

// Get total number of applicants
$applicantList = $con->query("SELECT * FROM applicant_list2");
$nr_of_rows = $applicantList->num_rows;

// Updated statuses without "Hired"
$statuses = ['Qualified', 'Pending', 'Pooling List']; // Change the order
$applicants = [];
foreach ($statuses as $status) {
    $applicants[$status] = $con->query("SELECT * FROM applicant_list2 WHERE status = '$status'");
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

    $stmt->close();
}


// Check if the status has changed
if (isset($_POST['status']) && in_array($_POST['status'], ['Pending', 'Pooling List'])) {
    $applicantId = $_POST['ID']; 

    // Update interview_date and interview_time to NULL
    $updateSql = "UPDATE applicant_list2 SET interview_date = NULL, interview_time = NULL WHERE ID = ?";
    $stmt = $con->prepare($updateSql);
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($con->error));
    }

    $stmt->bind_param("i", $applicantId);
    
    if (!$stmt->execute()) {
        echo "Error executing query: " . htmlspecialchars($stmt->error);
    } else {
        echo "Interview date and time removed successfully.";
    }

    $stmt->close();
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Onboarding</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <?php if ($is_admin): ?>

    <div class="right-container">
        <div class="box-container">
            <h2>Applicant Reports</h2>
            <div class="gauge-line"></div>

            <div class="applicant-buttons">
                <?php foreach ($statuses as $status): ?>
                <button class='status-button'
                    onclick='toggleStatus("<?php echo $status; ?>")'><?php echo $status; ?></button>
                <?php endforeach; ?>
            </div>

            <div id="applicant-tables">
                <?php foreach ($statuses as $status): ?>
                <div id="<?php echo $status; ?>" class="applicant-table"
                    style="display: <?php echo $status === 'Qualified' ? 'block' : 'none'; ?>;">
                    <h3><?php echo $status; ?>
                        Applicants</h3>
                    <!-- Status Header -->

                    <?php if (isset($message)): ?>
                    <p><?php echo $message; ?></p>
                    <?php endif; ?>

                    <?php
        if(isset($_SESSION['status-add'])){
            ?>
                <div class="status-add" id="statusPopup">
                    <?php echo $_SESSION['status-add']; ?>
                    <span class="close-btn" onclick="closePopup();">&times;</span>
                </div>
                <?php
                unset($_SESSION['status-add']);
            }
            ?>

                <?php
                if(isset($_SESSION['status-delete'])){
            ?>
                <div class="status-delete" id="statusPopup">
                    <?php echo $_SESSION['status-delete']; ?>
                    <span class="close-btn" onclick="closePopup();">&times;</span>
                </div>
                <?php
                unset($_SESSION['status-delete']);
            }
            ?>

                <?php
                if(isset($_SESSION['status-edit'])){
            ?>
                <div class="status-edit" id="statusPopup">
                    <?php echo $_SESSION['status-edit']; ?>
                    <span class="close-btn" onclick="closePopup();">&times;</span>
                </div>
                <?php
                unset($_SESSION['status-edit']);
            }
            ?>

                    <table id="table3">
    <thead>
        <tr>
            <th></th>
            <?php if ($status === 'Qualified'): ?>
            <th>Applicant ID</th> <!-- New column for Applicant ID -->
            <?php endif; ?>
            <th>Full Name</th>
            <th>Position Type</th>
            <th>Status</th>
            <th>Date Applied</th>
            <?php if ($status === 'Qualified'): ?>
            <th>Interview Date</th>
            <th>Interview Time</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $total_rows = $applicants[$status]->num_rows;
        $total_pages = ceil($total_rows / $rows_per_page);
        $current_page = isset($_GET['page-nr']) ? (int)$_GET['page-nr'] : 1;
        $current_status = isset($_GET['status']) ? $_GET['status'] : 'Pending';

        $start = ($current_page - 1) * $rows_per_page;
        $sql = "SELECT * FROM applicant_list2 WHERE status = '$status' LIMIT $start, $rows_per_page";
        $paginatedApplicants = $con->query($sql);
        $currentDate = date('M d, Y'); // Get the current date in the desired format

        if ($paginatedApplicants->num_rows > 0) {
            while ($applicant = $paginatedApplicants->fetch_assoc()) {
                echo "<tr>
                    <td style='width: 100px; text-align: center; vertical-align: middle;'>";
                if ($status === 'Qualified') {
                    echo "<form action='scheduleInterview.php' method='post'>
                            <input type='hidden' name='applicant_id' value='{$applicant['ID']}'>
                            <button type='submit' class='schedule-interview-button'>Schedule Interview</button>
                          </form><br>";
                }
                echo "<a href='view_pdf.php?ID={$applicant['ID']}&action=preview' target='_blank'>
                        <button class='preview-button'>View CV</button>
                    </a>
                </td>";
        
                if ($status === 'Qualified') {
                    $applicantID = str_pad($applicant['ID'], 3, '0', STR_PAD_LEFT);
                    echo "<td style='text-align: center;'>$applicantID</td>"; // Display Applicant ID
                }
        
                echo "<td style='text-align: center;'>{$applicant['first_name']} {$applicant['middle_name']} {$applicant['last_name']}</td>
                      <td style='text-align: center;'>
                            {$applicant['position_type']} - {$applicant['employee_type']}
                        </td>

                      <td style='text-align: center; color: black;'>{$applicant['status']}</td>
                      <td style='text-align: center;'>{$currentDate}</td>";
        
                if ($status === 'Qualified') {
                    $formattedInterviewDate = $applicant['interview_date'] ? (new DateTime($applicant['interview_date']))->format('M d, Y') : '';
                    $formattedInterviewTime = $applicant['interview_time'] ? (new DateTime($applicant['interview_time']))->format('h:i A') : '';
        
                    echo "<td style='text-align: center;'>{$formattedInterviewDate}</td>
                          <td style='text-align: center;'>{$formattedInterviewTime}</td>";
                }
        
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No applicants found</td></tr>";
        }
        ?>
    </tbody>
</table>



                    <div class="page-info">
                        Showing
                        <?php echo $current_page; ?>
                        of
                        <?php echo $total_pages; ?>
                        pages
                    </div>
                    <div class="pagination">
                        <?php
                        if ($current_page > 1) {
                            echo '<a class="aa" href="?page-nr='.($current_page - 1).'&status='.$status.'">Previous</a>';
                        }
                        for ($page = 1; $page <= $total_pages; $page++) {
                            echo '<a class="aa" href="?page-nr='.$page.'&status='.$status.'">'.$page.'</a>';
                        }
                        if ($current_page < $total_pages) {
                            echo '<a class="aa" href="?page-nr='.($current_page + 1).'&status='.$status.'">Next</a>';
                        }
                        ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
function toggleStatus(status) {
    const tables = document.querySelectorAll('.applicant-table');
    tables.forEach(table => {
        table.style.display = (table.id === status) ? 'block' : 'none';
    });
}
</script>


    <?php endif; ?>

</body>

</html>