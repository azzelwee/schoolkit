<div class="header">
        <div class="side-nav">
            <a href="dashboard.php"class="logo">
                <img src="img/nbswhite.png" class="logo-img">
            </a>
            <ul class="nav-links">
                <li><a href="dashboard.php"><img src="img/dashboard.png" class="imgs"><p>Dashboard</p></a></li>
                <li><a href="maintenance.php"><img src="img/structures.png"><p>Maintenance</p></a></li>
               
                <!-- <?php if ($is_admin): ?>
                <li><a href="employee.php"><img src="img/groups.png"><p>Employee</p></a></li>
                <?php endif; ?> -->
                
                <li><a href="reports.php"><img src="img/settings.png"><p>Reports</p></a></li>
                <?php if(isset($_SESSION['UserLogin'])){?>
                    <li><a href="logout.php"><img src="img/out.png"><p>Logout</p></a></li>
                    <?php } else {?>

                    <li><a href="login.php"><img src="img/out.png"><p>Login</p></a></li>
                <?php } ?>

                <div class="active">
                </div>
            </ul>

</div>