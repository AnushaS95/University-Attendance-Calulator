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
                <li class="breadcrumb-item active">Profile Management</li>
            </ol>
            <?php require_once 'includes/notification.php'; ?>
            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header">Update Profile</div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="action" value="update_profile"/> 
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="updateProfile">
                                    <?php if (!empty($_SESSION["user"]["extra"]["profile_pic"])) { ?>
                                        <img src="<?php echo SITE_URL; ?>/imgs/default-user.png" alt="User Default Image" />
                                    <?php } else { ?>
                                        <div class="userimage">
                                            <h2><?php echo substr($_SESSION["user"]["extra"]["first_name"], 0, 1) . "" . substr($_SESSION["user"]["extra"]["last_name"], 0, 1); ?></h2>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <input type="text" name="extra[first_name]" id="firstName" value="<?php echo $_SESSION["user"]["extra"]["first_name"]; ?>" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                                        <label for="firstName">First name</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-label-group">
                                        <input type="text" name="extra[last_name]" id="lastName" value="<?php echo $_SESSION["user"]["extra"]["last_name"]; ?>" class="form-control" placeholder="Last name" required="required">
                                        <label for="lastName">Last name</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <input readonly="true" type="email" name="email" id="inputEmail" class="form-control" value="<?php echo $_SESSION["user"]["email"]; ?>" placeholder="Email address" required="required">
                                        <label for="inputEmail">Email address</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                                        <label for="inputPassword">Password</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-label-group">
                                        <input type="password" name="confirm_password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                                        <label for="confirmPassword">Confirm password</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </form>
                </div>
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