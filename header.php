<?php
$is_admin = (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator");
$is_user = (isset($_SESSION['Access']) && $_SESSION['Access'] == "user");
?>

<div class="header">
        <div class="side-nav">
            <a href="dashboard.php"class="logo">
                <img src="img/nbswhite.png" class="logo-img">
            </a>
            <ul class="nav-links">
            
            <!-- <?php if($is_admin): ?>
                <li><a href="dashboard.php"><img src="img/dashboard.png" class="imgs"><p>Dashboard</p></a></li>
            <?php endif ?> -->



                <?php if ($is_user): ?>
                <li><a href="apply.php"><img src="img/apply.png" class="imgs"><p>Apply for a Job</p></a></li>
                <?php endif; ?>


                <?php if ($is_admin): ?>
                <li><a href="maintenance.php"><img src="img/structures.png"><p>Dashboard</p></a></li>
                <li><a href="employeeOnboarding.php"><img src="img/onboard.png"><p>Applicant&nbspProcessing</p></a></li>
                <li><a href="reports.php"><img src="img/settings.png"><p>Reports</p></a></li>
                <li><a href="index.php"><img src="img/out.png"><p>Logout</p></a></li>
                <?php endif; ?>
                
                <?php if ($is_admin): ?>
                <div class="active">
                </div>
                <?php endif; ?>

                <?php if ($is_user): ?>
                <div class="active2">
                </div>
                <?php endif; ?>

                
            </ul>

</div>