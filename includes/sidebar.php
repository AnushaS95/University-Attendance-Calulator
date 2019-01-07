<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item <?php echo CURRENT_PAGE_NAME == "Index" ? "active" : ""; ?>">
        <a class="nav-link" href="<?php echo SITE_URL; ?>index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <?php if ($_SESSION["user"]["role"] == "admin") { ?>
        <li class="nav-item <?php echo CURRENT_PAGE_NAME == "All-students" ? "active" : ""; ?>">
            <a class="nav-link" href="<?php echo SITE_URL; ?>all-students.php">
                <i class="fas fa-fw fa-users"></i>
                <span>Students Listing</span>
            </a>
        </li>
    <?php } ?>
    <li class="nav-item <?php echo CURRENT_PAGE_NAME == "Attendance-report" ? "active" : ""; ?>">
        <a class="nav-link" href="<?php echo SITE_URL; ?>attendance-report.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <?php if ($_SESSION["user"]["role"] == "admin") { ?>
                <span>Student Attendance Report</span>
            <?php } else { ?>
                <span>Attendance Report</span>
            <?php } ?>
        </a>
    </li>
</ul>