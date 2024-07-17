<?php
if (!isset($_SESSION)) {
    session_start();
}

$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == 'administrator');

include_once('connections/connection.php');
$con = connection();

// Fetch the applicant data
$applicants = $con->query("SELECT `ID`, `interview_date`, `first_name`, `middle_name`, `last_name`, `interview_time` FROM `applicant_list2`");
$names_by_date = [];

// Process the query results
while ($row = mysqli_fetch_assoc($applicants)) { // Use $applicants instead of $result
    $interview_date = $row['interview_date'];
    $names_by_date[$interview_date] = [
        'id' => $row['ID'], // Add the ID to the array
        'first_name' => $row['first_name'],
        'middle_name' => $row['middle_name'],
        'last_name' => $row['last_name'],
        'interview_time' => $row['interview_time'],
    ];
}

// Fetch holidays
$holidays_result = $con->query("SELECT `date`, `name` FROM `holidays`");
$holidays_by_date = [];

while ($holiday = $holidays_result->fetch_assoc()) {
    $holidays_by_date[$holiday['date']] = $holiday['name'];
}



$current_month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
$current_year = date('Y');

// Handle year rollover for December
if ($current_month > 12) {
    $current_month = 1;
    $current_year++;
}

// Handle year rollover for January
if ($current_month < 1) {
    $current_month = 12;
    $current_year--;
}

// Calculate previous and next month
$prev_month = $current_month - 1;
$next_month = $current_month + 1;

if ($prev_month < 1) {
    $prev_month = 12;
    $current_year--;
}

function days_in_month($month, $year) {
    return cal_days_in_month(CAL_GREGORIAN, $month, $year);
}

function get_notes($con, $year, $month, $day) {
    $date = "$year-$month-$day";
    $sql = "SELECT note FROM notes WHERE date = '$date'";
    $result = $con->query($sql);
    $note = $result->fetch_assoc();
    return $note ? $note['note'] : '';
}

function get_holidays($con, $year, $month) {
    $start_date = "$year-$month-01";
    $end_date = "$year-$month-" . days_in_month($month, $year);
    $sql = "SELECT * FROM holidays WHERE date BETWEEN '$start_date' AND '$end_date'";
    return $con->query($sql);
}
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Calendar Note</title>
    <link rel='stylesheet' href='css/style.css'>

</head>

<body id="<?php echo $id ?>">

    <?php include 'header.php'; ?>

    <div class='right-container'>
        <div class='box-container'>
            <h2>Calendar Note</h2>
            <div class='gauge-line'></div>
            <p>The calendar provides information regarding key dates in the application process, including
                interview schedules and important events.</p>
                <div class="calendar">
    <div class="month">
        <h3><?php echo date('F', mktime(0, 0, 0, $current_month, 1)) . ' ' . $current_year; ?></h3>
        <div class="days">
            <?php
            $days = days_in_month($current_month, $current_year);
            
            for ($i = 1; $i <= $days; $i++): 
                $current_date = sprintf("%04d-%02d-%02d", $current_year, $current_month, $i);
                $note = get_notes($con, $current_year, $current_month, $i);

                // Check if the current date has an interview
                $has_interview = isset($names_by_date[$current_date]);
                $interview_text = '';

// Prepare the interview text with ID included
if ($has_interview) {
    $id = $names_by_date[$current_date]['id'];
    $first_name = $names_by_date[$current_date]['first_name'];
    $middle_name = $names_by_date[$current_date]['middle_name'];
    $last_name = $names_by_date[$current_date]['last_name'];
    $interview_time = $names_by_date[$current_date]['interview_time'];
    $full_name = trim("$first_name $middle_name $last_name"); // Combine names

    // Format the interview time to 12-hour format with AM/PM
    $formatted_time = date('h:i A', strtotime($interview_time));

    // Prepare the interview text
    $interview_text = "Interview\n Applicant: 00$id\n $formatted_time";
}


                // Check if the current date is a holiday and fetch the holiday name
                $holiday_name = isset($holidays_by_date[$current_date]) ? $holidays_by_date[$current_date] : '';
                $is_holiday = isset($holidays_by_date[$current_date]);
            ?>
<div class="day <?php echo $is_holiday ? 'holiday' : ($has_interview ? 'interview' : ''); ?>" id="day-<?php echo $current_month . '-' . $i; ?>">
    <?php echo $i; ?>
    <textarea class="note" data-date="<?php echo $current_date; ?>">
        <?php echo htmlspecialchars($note); ?>
    </textarea>
    <?php if ($interview_text): ?>
        <div class="interview-info"><?php echo nl2br(htmlspecialchars($interview_text)); ?></div>
    <?php endif; ?>
    <?php if ($is_holiday): ?>
        <div class="holiday-info"><?php echo htmlspecialchars($holiday_name); ?></div>
    <?php endif; ?>
</div>
<?php endfor; ?>
                    </div>
                </div>


            </div>
            <div class="nav-buttons" style="text-align: center;">
                    <a href="?month=<?php echo $prev_month; ?>" class="prev-button">Previous</a>
                    <a href="?month=<?php echo $next_month; ?>" class="next-button">Next</a>
                    <a href="addHolidays.php" class="next-button">Configure</a>
                    <button id="save-notes" class="thebuttonc">Save</button>
                </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $('#save-notes').on('click', function() {
        $('.note').each(function() {
            var date = $(this).data('date');
            var note = $(this).val();

            console.log('Saving:', {
                date: date,
                note: note
            }); // Log the values

            $.ajax({
                url: 'save_note.php',
                method: 'POST',
                data: {
                    date: date,
                    note: note
                },
                success: function(response) {
                    console.log('Saved:', response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error saving note:', textStatus, errorThrown);
                }
            });
        });
        alert("All notes have been saved!");
    });
    </script>

</body>

</html>