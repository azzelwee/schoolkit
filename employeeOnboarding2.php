<?php

if(!isset($_SESSION)){
    session_start();
}

$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");

include_once("connections/connection.php");
$con = connection();
$rows_per_page = 10;

// Get total number of applicants
$applicantList = $con->query("SELECT * FROM applicant_list2");
$nr_of_rows = $applicantList->num_rows;

// Updated statuses without "Hired"
$statuses = ['Pending', 'Pooling List', 'Qualified'];
$applicants = [];
foreach ($statuses as $status) {
    $applicants[$status] = $con->query("SELECT * FROM applicant_list2 WHERE status = '$status'");
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
                <button class='status-button' onclick='toggleStatus("<?php echo $status; ?>")'><?php echo $status; ?></button>
            <?php endforeach; ?>
        </div>

        <div id="applicant-tables">
            <?php foreach ($statuses as $status): ?>
                <div id="<?php echo $status; ?>" class="applicant-table" style="display: <?php echo $status === 'Pending' ? 'block' : 'none'; ?>;">
                    <h3><?php echo $status; ?> Applicants</h3> <!-- Status Header -->
                    <table id="table3">
    <thead>
        <tr>
            <th></th>
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
                    </td>
                    <td style='text-align: center;'>{$applicant['first_name']} {$applicant['middle_name']} {$applicant['last_name']}</td>
                    <td style='text-align: center;'>{$applicant['position_type']}</td>
                    <td style='text-align: center; color: black;'>{$applicant['status']}</td>
                    <td style='text-align: center;'>{$currentDate}</td>";
        
                    if ($status === 'Qualified') {
                        $interviewDate = new DateTime($applicant['interview_date']);
                        $interviewTime = new DateTime($applicant['interview_time']);
                        
                        echo "<td style='text-align: center;'>" . $interviewDate->format('M d, Y') . "</td>
                              <td style='text-align: center;'>" . $interviewTime->format('h:i A') . "</td>";
                    }
                    
        
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No applicants found</td></tr>";
        }
        
    ?>
    </tbody>
</table>


                    <!-- Showing results info -->
                    <div class="page-info">
                        Showing <?php echo $current_page; ?> of <?php echo $total_pages; ?> pages
                    </div>

                    <!-- Pagination for each status -->
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
        table.style.display = (table.id === status) ? (table.style.display === 'none' ? 'block' : 'none') : 'none';
    });
}
</script>

<?php endif; ?>

</body>
</html>
