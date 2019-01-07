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
                <li class="breadcrumb-item active">Students Listing</li>
            </ol>

            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header"><i class="fas fa-table"></i> All Students</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Added on</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $allStudents = $user_obj->getallStudents();
                                if (!empty($allStudents)) {
                                    foreach ($allStudents as $value) {
                                        $created = date("F j, Y, g:i A", strtotime($value["created"]));
                                        ?>
                                        <tr>
                                            <td><?php echo $value["extra"]["first_name"] . " " . $value["extra"]["last_name"]; ?></td>
                                            <td><?php echo $value["email"]; ?></td>
                                            <td><?php echo $created; ?></td>
                                            <td class="action">
                                                <a data-toggle="tooltip" href="<?php echo SITE_URL; ?>/attendance-report.php?reportof=<?php echo $value["email"]; ?>" title="View Student Report">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <?php if ($value["is_active"] == 1) { ?>
                                                    <a data-toggle="tooltip" href="javascript:;" onclick="changeUserActivity(this,<?php echo $value['id'] ?>)" title="Block User">
                                                        <i class="fa fa-user-times" aria-hidden="true"></i>
                                                    </a>
                                                <?php } else { ?>
                                                    <a data-toggle="tooltip" href="javascript:;" onclick="changeUserActivity(this,<?php echo $value['id'] ?>)" title="Un-block User">
                                                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
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