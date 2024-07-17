<?php

if (!isset($_SESSION)) {
    session_start();
}

$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == 'administrator');

include_once('connections/connection.php');
$con = connection();

$rows_per_page = 5;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $name = $_POST['name'];

    // Prepare the SQL statement
    $query = "INSERT INTO `holidays`(`date`, `name`) VALUES (?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $date, $name);

    if ($stmt->execute()) {
        $_SESSION['status-add'] = "Records Successfully Submitted.";
    } else {
        $_SESSION['status-delete'] = "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM `holidays` WHERE `id` = ?";
    $delete_stmt = $con->prepare($delete_query);
    $delete_stmt->bind_param("i", $delete_id);

    if ($delete_stmt->execute()) {
        $_SESSION['status-delete'] = "Holiday deleted successfully!";
    } else {
        $_SESSION['status-delete'] = "Error: " . $stmt->error;
    }

    $delete_stmt->close();
}

// Determine the current page number
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page < 1) {
    $current_page = 1;
}

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $rows_per_page;

// Fetch holidays with pagination
$fetch_query = "SELECT * FROM `holidays` LIMIT $rows_per_page OFFSET $offset";
$result = $con->query($fetch_query);

// Fetch total number of rows for pagination
$total_query = "SELECT COUNT(*) as total FROM `holidays`";
$total_result = $con->query($total_query);
$total_row = $total_result->fetch_assoc();
$total_rows = $total_row['total'];
$total_pages = ceil($total_rows / $rows_per_page);

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Reports</title>
    <link rel='stylesheet' href='css/style.css'>
</head>

<body id="<?php echo $id ?>">

    <?php include 'header.php'; ?>

    <div class='right-container'>

        <div class='box-container'>
            <h2>Manage Calendar Holiday</h2>
            <div class='gauge-line'></div>

            <form method="POST" action="">
            <div class="add-employee-form">
                <div class="column">
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" required>
                    </div>

                    

                    <div class="form-group">
                        <label for="name">Holiday Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                </div>

                    <button type="submit" class="thebuttonx">Submit</button>
                    </div>
                
            </form>

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
            <table id="table2-2">
 
                <thead>
                    <tr>
                        <th style="width: 100px;">Date</th>
                        <th style="width: 150px;">Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td style="text-align: center;">
                                    <?php 
                                    $date = new DateTime($row['date']);
                                    echo $date->format('M d, Y'); 
                                    ?>
                                </td>
                                <td><?php echo $row['name']; ?></td>
                                <td style="width: 20px; text-align:center;">
                                    <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this holiday?');">
                                    <img src='img/delete.png' style="width: 25px; height: 25px;" alt='Delete'>

                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No holidays found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination2">
    <a href="?page=<?php echo max($current_page - 1, 1); ?>">Previous</a>

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <?php if ($i == $current_page): ?>
            <strong><?php echo $i; ?></strong>
        <?php else: ?>
            <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <a href="?page=<?php echo $current_page + 1; ?>">Next</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>
<script src="js/main.js"></script>

</html>
