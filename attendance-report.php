<?php
include_once 'config.php';
include_once 'classes/core.php';
(empty($_SESSION["user"])) ? $user_obj->redirect(SITE_URL . "login.php") : "";
include_once 'includes/header.php';
include_once 'includes/top-nav.php';
?>
<div id="wrapper">
    <?php include_once 'includes/sidebar.php'; ?>
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo SITE_URL; ?>/index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Attendance Report</li>
            </ol>

            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header"><i class="fas fa-table"></i> Previous Attendance List</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <?php if ($_SESSION["user"]["role"] == "admin") { ?>
                                        <th>Student</th>
                                    <?php } ?>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Attendance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $userid = ($_SESSION["user"]["role"] == "user") ? $_SESSION["user"]["id"] : "-1";
                                if (isset($_REQUEST["reportof"])) {
                                    $userReportID = $user_obj->getDetails("users", "email='" . $_REQUEST["reportof"] . "'");
                                    $userid = $userReportID["id"];
                                }
                                $attendanceReport = $user_obj->getAttendanceReport($userid);
                                if (!empty($attendanceReport)) {
                                    foreach ($attendanceReport as $value) {
                                        $fullDate = strtotime($value["attendance_datetime"]);
                                        $date = date('F j, Y', $fullDate);
                                        $time = date('H:i A', $fullDate);
                                        ?>
                                        <tr>
                                            <?php if ($_SESSION["user"]["role"] == "admin") { ?>
                                                <td><?php echo $value["email"]; ?></td>
                                            <?php } ?>
                                            <td><?php echo $date; ?></td>
                                            <td><?php echo $time; ?></td>
                                            <td>Yes</td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted">Updated today at <?php echo date("h:i A") ?></div>
            </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; <?php echo WEBSITE_NAME . " " . date("Y"); ?></span>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->
<?php
include_once 'includes/footer.php';
?>