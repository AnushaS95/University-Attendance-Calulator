<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <div class="col-md-6">
        <a class="navbar-brand mr-1" href="index.html">Attendance System</a>
        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <div class="col-md-6">
        <!-- Navbar -->
        <ul class="float-right navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?php echo SITE_URL; ?>profile-management.php">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;" data-toggle="modal" data-target="#logoutModal">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>