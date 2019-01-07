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
                <li class="breadcrumb-item active">Overview</li>
            </ol>
            <?php require_once 'includes/notification.php'; ?>
            <?php
            if ($_SESSION["user"]["role"] == "user") {
                include_once('includes/dashboard/userpage.php');
            }
            if ($_SESSION["user"]["role"] == "admin") {
                include_once('includes/dashboard/adminpage.php');
            }
            ?>
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